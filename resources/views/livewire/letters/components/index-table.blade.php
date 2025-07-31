<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Created Date</th>
            <th>Publication Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($letters as $letter)
            @include('livewire.letters.includes.index-row')
        @endforeach
    </tbody>
</table>
<br><br>
<div class="row">
    <div class="col">
        {{ $letters->links() }}
    </div>
</div>
