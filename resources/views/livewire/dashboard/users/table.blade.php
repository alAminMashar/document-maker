<div class="col grid-margin stretch-card">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="card-title text-primary">
                Recently Added Users
            </h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @include('livewire.dashboard.users.row')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
