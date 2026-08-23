@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Author Details</h5>
                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-light btn-sm">Edit</a>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">ID:</th>
                            <td>{{ $author->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $author->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $author->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $author->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Website:</th>
                            <td>
                                @if($author->website)
                                    <a href="{{ $author->website }}" target="_blank">{{ $author->website }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge {{ $author->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $author->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $author->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    </table>
                    <div class="mt-3">
                        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection