<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Traits\TagTrait;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ImageInterface;
use App\Interfaces\NewsInterface;
use App\Interfaces\CategoryNewsInterface;
use App\Models\Image;
use App\Models\Tag;
use Exception;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class NewsController extends Controller
{
    use TagTrait;
    private $imageInterface;
    private $categoryNewsInterface;
    private $newsInterface;
    private $categoryInterface;
    public function __construct(
        ImageInterface $imageInterface,
        NewsInterface $newsInterface,
        CategoryNewsInterface $categoryNewsInterface,
        CategoryInterface $categoryInterface
    ) {
        $this->imageInterface = $imageInterface;
        $this->newsInterface = $newsInterface;
        $this->categoryNewsInterface = $categoryNewsInterface;
        $this->categoryInterface = $categoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($this->newsInterface->paginate(20)[0]->is_featured_image());
        return view('admin.news.index')->with([
            'news' => $this->newsInterface->paginate(20),
            // 'menu'=> 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $this->imageInterface->paginate(1);
        $imageListing = view('admin.setting.media.components.image-listing', [
            'images' => $this->imageInterface->paginate(5)
        ])->render();
        // return response($imageListing);
        if ($request->ajax()) {
            return response($imageListing, 200);
        }
        return view('admin.news.create')->with([
            'categories' => $this->categoryInterface->all(),
            'images' => $this->imageInterface->all(),
            'imageListing' => $imageListing,
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $allTagIds = $this->syncTags($request);
            if ($request->hasFile('featured_image')) {
                $request->validate([
                    'featured_image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                ]);
                $values = $request->all();
                $featured_image_name =  $this->imageInterface->upload($request->file('featured_image'));
                $news = $this->newsInterface->create($request->all() + ['featured_image_name' => $featured_image_name]);
                $news->tags()->sync($allTagIds);
                $featured_image = $this->imageInterface->create(['image_name' => $featured_image_name, 'news_id' => $news->id]);
            } else {
                $request->validate(['image_id' => 'required']);
                $image = $this->imageInterface->findById($request->image_id);
                $news = $this->newsInterface->create($request->all() + ['featured_image_name' => $image->image_name]);
                $news->tags()->sync($allTagIds);
            }
            // add category;
            foreach ($request->news_categories as $news_category_id) {
                $this->categoryNewsInterface->create([
                    'category_id' => $news_category_id,
                    'news_id' => $news->id
                ]);
            }
            //add tag
            return back()->with('success', 'News successfully created !!');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to create News !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // dd($this->newsInterface->findById($id)->images[0]->is);
        $imageListing = view('admin.setting.media.components.image-listing', [
            'images' => $this->imageInterface->paginate(5)
        ])->render();
        // return response($imageListing);
        if ($request->ajax()) {
            return response($imageListing, 200);
        }
        $categoryNews = $this->categoryInterface->selectedCategories($id);
        $selectedCategoryIds = array();
        foreach ($categoryNews as $item) {
            array_push($selectedCategoryIds, $item->category_id);
        }
        return view('admin.news.edit')->with([
            'news' => $this->newsInterface->findById($id),
            'categories' => $this->categoryInterface->all(),
            'selectedCategoryIds' => $selectedCategoryIds,
            'imageListing' => $imageListing,
            'tags' => Tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $allTagIds = $this->syncTags($request);

            $image_name = $this->newsInterface->news_featured_image_name($id);
            // dd($image_name);
            if ($request->hasFile('featured_image')) {
                $request->validate([
                    'featured_image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                ]);
                $image_name = $this->imageInterface->upload($request->file('featured_image'));
                $values = [
                    'image_name' => $image_name,
                    'news_id' => $id,
                ];
                $this->imageInterface->create($values);
            } else if (isset($request->image_id)) {
                $image_name = $this->imageInterface->findById($request->image_id)->image_name;
            }
            $news = $this->newsInterface->findById($id);
            foreach ($news->category_news as $categoryNews) {
                $this->categoryNewsInterface->delete($categoryNews->id);
            }
            //update new category
            foreach ($request->news_categories as $news_category) {
                $this->categoryNewsInterface->create([
                    'category_id' => $news_category,
                    'news_id' => $id
                ]);
            }
            //update tags
            $news->tags()->sync($allTagIds);

            $is_news_updated = $this->newsInterface->update($request->all() + ['featured_image_name' => $image_name], $id);
            return  back()->with('success', 'successfully updated');
        } catch (Exception $e) {
            return back()->with('error', 'failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $is_deleted = $this->newsInterface->delete($id);
        if ($is_deleted) {
            //unlink image

            return back()->with('success', 'deleted successfully !');
        }
        return back()->with('error', 'Oops! failed to delete');
    }
    public function deleteSelectedNews(Request $request)
    {
        // dd($request->all());
        $news_id = $request->news_id;
        try {
            foreach ($news_id as $id) {
                $this->newsInterface->delete($id);
            }
        } catch (\Exception $e) {
        }
        return back()->with('success', 'Successfully Deleted !!');
    }
    public function validateNews($values)
    {
        return Validator::make($values, [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required'],
            'description' => ['required'],
            'featured_image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'news_categories' => ['required'],
            'tags' => ['required', 'string', 'max:255'],
        ]);
    }
}
