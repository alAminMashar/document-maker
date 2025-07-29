<div>
    <div class="form-group">
        <label for="permissions" class="form-label">Assign Permissions</label>

        <table class="table table-striped">
            <thead>
                <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                <th scope="col" width="20%">Name</th>
                <th scope="col" width="1%">Guard</th>
            </thead>

            @foreach ($permissions as $permission)
                <tr>
                    <td>
                        <input type="checkbox" name="permission[{{ $permission->name }}]"
                            value="{{ $permission->name }}" class='permission'>
                    </td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="form-group col-6">
        <label for="exampleDataList" class="form-label">Datalist example</label>
        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
        <datalist id="datalistOptions">
            <option value="San Francisco">
            <option value="New York">
            <option value="Seattle">
            <option value="Los Angeles">
            <option value="Chicago">
        </datalist>
    </div>
</div>
