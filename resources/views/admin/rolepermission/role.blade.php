@extends('admin.layout.master')
@section('title','Role List')
@section('page-breadcrumb','Role List')
@push('admin.custom.style')
    <style>
        .button-group {
            display: flex;
            gap: 10px;
        }

        .button-group .btn {
            margin-bottom: 0;
        }
    </style>
@endpush

@section('admin.content')

    <div class="card pd-20 pd-sm-40">
        <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
                <thead>
                <tr>
                    <th class="wd-15p">Id</th>
                    <th class="wd-15p">Name</th>
                    <th class="wd-15p">Description</th>
                    <th class="wd-10p">Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($roles as $key => $role)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->description}}</td>
                        <td>
                            <div class="button-group">
                                <a href="{{route('admin.role.details',$role->id)}}" class="btn btn-secondary">
                                    <i class="fa-solid fa-pen-to-square"></i></a>
    {{--                                <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteUser('{{$role->id}}')">--}}
    {{--                                    <i class="fa-solid fa-trash"></i></a>--}}
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div><!-- table-wrapper -->
    </div><!-- card -->

@endsection

@push('admin.custom.script')
    <script>

        const csrfToken = document.head.querySelector(
            "[name=csrf_token][content]"
        ).content;

        $('#datatable1').DataTable({
            bLengthChange: true,
            searching: true,
            responsive: true
        });

        function getUserInfo(userId){
            let userUrl = '{{ route('admin.user.details', ['id' => ':id']) }}';
            userUrl = userUrl.replace(':id', userId);

            fetch(userUrl, {
                method: "GET",
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok.");
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.status == true) {

                        let name = data.data.name
                        let email = data.data.email
                        let role = data.data.user_role
                        let date = data.data.userDate

                        document.querySelector('input[name="name"]').value = name;
                        document.querySelector('input[name="email"]').value = email;
                        document.querySelector('input[name="role"]').value = role;
                        document.querySelector('input[name="date"]').value = date;
                        document.querySelector('input[name="userId"]').value = data.data.id

                    }
                })
                .catch((error) => {
                    console.error("There was a problem with the fetch operation:", error);

                });
        }

        async function updateUser(){
            let userId = document.querySelector('input[name="userId"]').value
            let UserName = document.querySelector('input[name="name"]').value

            try {
                const response = await fetch('{{ route('admin.update.user.details') }}', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        userId: userId,
                        UserName: UserName,
                    })
                });

                if (response.ok) {
                    const data = await response.json()
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: data.message
                    });

                    setTimeout(()=>{
                        window.location.reload();
                    },1000)
                }
            }
            catch (error) {
                console.error('There was a problem with the fetch operation:', error);

            }

        }

        function deleteUser(userId){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    let userDltRoute = '{{route('admin.delete.user',['id'=>':id'])}}'
                    userDltRoute = userDltRoute.replace(':id', userId);
                    window.location = userDltRoute
                }
            });
        }


    </script>
@endpush
