<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="fw-bold"> Title </th>
                                <th class="fw-bold"> Details </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Name
                                </td>
                                <td>
                                    {{ $role->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Guard
                                </td>
                                <td>
                                    {{ $role->guard_name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Permissions
                                </td>
                                <td>
                                    {{ $role->permissions()->count() }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Date Created
                                </td>
                                <td>
                                    {{ $role->created_at }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
