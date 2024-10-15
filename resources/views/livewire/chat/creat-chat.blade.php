<div>
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="text-align: center" class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الدكتور</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><button wire:click="creatConversation('{{$user->email}}')" class="btn btn-primary">{{$user->name}}</button></td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- bd -->
        </div><!-- bd -->
    </div>
    <!--/div-->

    </div>
</div>
