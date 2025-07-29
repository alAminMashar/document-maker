<?php

namespace App\Http\Livewire\HelpGuide;

use Livewire\WithPagination;
use Livewire\Component;

use App\Models\Article;
use App\Models\SubTopic;

use App\Models\Tag;
use Spatie\Permission\Models\Permission;
use DB;

class Index extends Component
{

    /*-----------------------------------------------

        Search Stuff and Pagination

     *----------------------------------------------*/
    use WithPagination;

    // use Livewire\WithPagination; add this to top

    public $search = '';

    public function updateSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

     /*-----------------------------------------------

        End of Search Stuff and Pagination

     *----------------------------------------------*/

    public $articleId;

    public $tags, $sub_topics, $permissions;

    public $selected_permissions = [], $rolePermissions;

    public $title, $body, $rating, $author_id, $sub_topic_id;

    public $updateArticle = false, $addArticle = false;



    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteArticleListner'    =>  'deleteArticle'
    ];

     /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title'           =>    'required|unique:articles',
        'body'            =>    'required',
        'author_id'       =>    'required',
        'sub_topic_id'    =>    'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->title            =   '';
        $this->body             =   '';
        $this->sub_topic_id     =   '';
        $this->selected_permissions  =   [];
    }

    public function mount()
    {
        $this->tags = Tag::all();
        $this->sub_topics = SubTopic::all();
        $this->author_id = auth()->user()->id;
        $this->permissions = Permission::orderBy('name','ASC')->get();
    }

    public function render()
    {

        $articles = Article::where('title','like','%'.$this->search.'%')
        ->orderBy('title','ASC')
        ->paginate(config('app.paginate'));

        return view('livewire.help-guide.index',['articles'=>$articles])
        ->extends('layouts.app')
        ->section('content');

    }

    /**
     * Open Add Article form
     * @return void
     */
    public function addArticle()
    {
        $this->resetFields();
        $this->addArticle = true;
        $this->updateArticle = false;
    }

    /**
      * store the Article inputted Article data in the articles table
      * @return void
      */
    public function storeArticle()
    {
        $validated = $this->validate();

        try {

            $article = Article::create($validated);

            $article->permissions()->sync($this->selected_permissions);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Article Created Successfully!"
            ]);

            $this->resetFields();
            $this->addArticle = false;

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "$ex Something went wrong! We could not add the topic."
            ]);

        }
    }


    /**
     * show existing Article data in edit Article form
     * @param mixed $id
     * @return void
     */
    public function editArticle(Article $article){
        try {

            $this->articleId        =   $article->id;
            $this->title            =   $article->title;
            $this->body             =   $article->body;
            $this->author_id        =   $article->author_id;
            $this->sub_topic_id     =   $article->sub_topic_id;
            $this->updateArticle    =   true;
            $this->addArticle       =   false;

            $this->selected_permissions = DB::table("article_permissions")
                ->where("article_permissions.article_id",$article->id)
                ->pluck('article_permissions.permission_id',
                'article_permissions.permission_id')
                ->all();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }

    }

    /**
     * update the Article data
     * @return void
     */
    public function updateArticle(Article $article){

        $validated = $this->validate([
            'title'           =>    'required|unique:articles,title,'.$this->articleId,
            'body'            =>    'required',
            'author_id'       =>    'required',
            'sub_topic_id'    =>    'required',
        ]);

        try {

            $article->update($validated);

            $article->permissions()->sync($this->selected_permissions);

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Article updated successfully!"
            ]);

            $this->updateArticle = false;
            $this->resetFields();

        } catch (\Exception $ex) {

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "$ex Something went wrong!"
            ]);

        }
    }

    public function showArticle(Article $article){
        return redirect()->route('help-guide.show',['article'=>$article]);
    }


    /**
     * Cancel Add/Edit form and redirect to Article listing page
     * @return void
     */
    public function cancelArticle()
    {
        $this->addArticle = false;
        $this->updateArticle = false;
        $this->resetFields();
    }

     /**
     * delete specific Article data from the articles table
     * @param mixed $id
     * @return void
     */
    public function deleteArticle(Article $article)
    {
        try{

            $article->delete();

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "success",
                'message'   =>  "Article deleted successfully!"
            ]);

        }catch(\Exception $e){

            $this->dispatchBrowserEvent('alert',[
                "type"      =>  "error",
                'message'   =>  "Something went wrong!"
            ]);

        }
    }
}
