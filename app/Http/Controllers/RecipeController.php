<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('admin.Recipe.recipe', compact('recipes'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'link' => 'required'

        ]);
        Recipe::create([
            'title' => $request['title'],
            'parent_id' => $request['parent_id'],
            'content' => $request['content'],
            'link' => $request['link'],

        ]);
        toastr()->success('Add Record Successfully');
        return redirect()->back();
    }
    public function editRecipe(Recipe $recipe)
    {
        $recipes = Recipe::all();
        return view('admin.Recipe.edit', compact('recipe', 'recipes'));
    }
    public function updateRecipe(Request $request, Recipe $recipe)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'link' => 'required'
        ]);
        $recipe->update([

            'title' => $request['title'],
            'content' => $request['content'],
            'parent_id' => $request['parent_id'],
            'link' => $request['link'],
        ]);
        toastr()->success('Update Successfully');
        return redirect()->route('add.recipe');
    }
    public function delete(Recipe $recipe)
    {

        $recipe->delete();
        toastr()->success('Delete Successfully');
        return redirect()->back();
    }
}
