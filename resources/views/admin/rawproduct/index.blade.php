@extends('admin.layout.master')

@section('title','User List')
@section('page-breadcrumb','User List')

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
                    <th class="wd-15p">Product Name</th>
                    <th class="wd-15p">Product price</th>
                    <th class="wd-10p">Action</th>

                </tr>
                </thead>
               <tbody>
               @foreach($allProducts as $key => $product)
                   <tr>
                       <td>{{++$key}}</td>
                       <td>{{$product->name}}</td>
                       <td>{{$product->price}}</td>
                       <td>
                           <div class="button-group">
                               <a href="{{route('admin.product.details',$product->prefix)}}" data-userId="{{$product->id}}" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                               <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteUser('{{$product->prefix}}')"><i class="fa-solid fa-trash"></i></a>
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
                    let uRole = data.user_role
                    let date = data.data.userDate
                    let allRoles = data.allRoles

                    document.querySelector('input[name="name"]').value = name;
                    document.querySelector('input[name="email"]').value = email;
                    document.querySelector('input[name="date"]').value = date;
                    document.querySelector('input[name="userId"]').value = data.data.id

                    let roleSelect =`<option label="Choose role"></option>`
                    Object.values(allRoles).forEach((role)=>{
                        let selected = role.id == uRole ? 'selected':'';
                        roleSelect+=` <option ${selected} value="${role.id}">${role.name}</option>`;
                    })

                    document.querySelector('.allRoles').insertAdjacentHTML('afterbegin',roleSelect)

                }
            })
            .catch((error) => {
                console.error("There was a problem with the fetch operation:", error);

            });
    }

    async function updateUser(){
         let userId = document.querySelector('input[name="userId"]').value
         let UserName = document.querySelector('input[name="name"]').value
         let selectedRole = document.querySelector('select[name="role"]')
         let roleId = selectedRole.options[selectedRole.selectedIndex].value


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
                    roleId: roleId,
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

    function deleteUser(slug){
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

                let userDltRoute = '{{route('admin.product.delete',['slug'=>':slug'])}}'
                userDltRoute = userDltRoute.replace(':slug', slug);
                window.location = userDltRoute
            }
        });
    }


</script>
@endpush
