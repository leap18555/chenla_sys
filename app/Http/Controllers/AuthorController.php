<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Show all authors (with pagination)
    public function index()
    {
        $authors = Author::paginate(5);
        return view('authors.index', compact('authors'));
    }

    // Show create form
    public function create()
    {
        return view('authors.create');
    }

    // Store new author
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        Author::create($validated);

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    // Show one author
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    // Show edit form
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    // Update author
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email,' . $author->id,
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        $author->update($validated);

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    // Delete author
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
