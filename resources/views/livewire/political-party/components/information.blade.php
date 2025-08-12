<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                {{-- <h4 class="card-title">{{ $customer->first_name . "'s Details" }}</h4> --}}
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
                                    Full Name
                                </td>
                                <td>
                                    {{ $customer->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Email
                                </td>
                                <td>
                                    {{ $customer->email }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Phone
                                </td>
                                <td>
                                    {{ $customer->phone }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">
                                    <span class="mdi mdi-envelope"></span>
                                    Date Created
                                </td>
                                <td>
                                    {{ $customer->created_at }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
