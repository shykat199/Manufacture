@extends('admin.layout.master')
@section('title','Role Permission List')
@section('page-breadcrumb','Role Permission List')
@push('admin.custom.style')
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .item {
            flex: 1 1 10%;
            box-sizing: border-box;
            padding: 10px;
        }
    </style>
@endpush

@section('admin.content')
    <div class="card pd-20 pd-sm-40">
        <form action="{{route('admin.update.role-permission',$roleDetails->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg">
                    <input class="form-control" name="role" placeholder="Input box" value="{{$roleDetails->name}}" type="text">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg">
                    <div class="card rounded-0">
                        <div class="card-header card-header-default">
                            Permission
                        </div><!-- card-header -->

                        <div class="card-body bg-gray-200">
                            <div class="container">
                                @foreach ($chunkData as $chunk)
                                    <div class="row">
                                        @foreach ($chunk as $permission)
                                            <div class="item">
                                                <label class="ckbox" id="permission-{{ $permission['id'] }}">
                                                    <input name="permission[]"
                                                        {{isset($rolePermissionIds) && !empty($rolePermissionIds) && in_array($permission['id'] ,$rolePermissionIds) ?'checked':''}}
                                                        id="{{ $permission['id'] }}" value="{{ $permission['id'] }}"
                                                           type="checkbox">
                                                    <span>{{ $permission['permission_name'] }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-2">
                                    <button class="btn btn-primary btn-block">Update</button>
                                </div>
                            </div>

                        </div><!-- card-body -->


                    </div>
                </div>
            </div>
        </form>
    </div>

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


        function getUserInfo(userId) {
            let userUrl = '{{ route('admin.role-permission.details', ['id' => ':id']) }}';
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

                        let name = data.data.name;
                        let rolePermissions = data.data.permissions;
                        let allPermissions = data.allPermissions;
                        let options = '';

                        const rolePermissionIds = rolePermissions.map(permission => permission.id);

                        allPermissions.forEach((permission) => {
                            const selected = rolePermissionIds.includes(permission.id) ? 'selected' : '';
                            options += `<option value="${permission.id}" ${selected}>${permission.permission_name}</option>`;
                        });

                        document.querySelector('input[name="role"]').value = name;
                        document.querySelector('input[name="roleId"]').value = data.data.id;

                        document.getElementById('rolePermissions').innerHTML = options;


                    }
                })
                .catch((error) => {
                    console.error("There was a problem with the fetch operation:", error);

                });
        }

        async function updateUser() {
            let roleId = document.querySelector('input[name="roleId"]').value
            let roleName = document.querySelector('input[name="role"]').value
            const select = document.getElementById('rolePermissions');
            const selectedOptions = select.selectedOptions;
            let selectedValues = [];
            for (let option of selectedOptions) {
                selectedValues.push(option.value);
            }

            try {
                const response = await fetch('{{ route('admin.update.role.permission') }}', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        roleId: roleId,
                        roleName: roleName,
                        selectedValues: selectedValues,
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

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000)
                }
            } catch (error) {
                console.error('There was a problem with the fetch operation:', error);

            }

        }

        function deleteUser(userId) {
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
