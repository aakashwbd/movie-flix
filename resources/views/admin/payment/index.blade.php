@extends('layouts.admin.index')
@section('content')
    <main class="main">
        <section class="dashboard-package">
            <h6 class="portion-title">Recent Payment</h6>

{{--            <button class="btn btn-primary rounded-32 my-3" data-bs-target="#inviteModal" data-bs-toggle="modal">Generate Invite Code</button>--}}

            <table class="table table-bordered payment-table mt-5">
                <thead>
                <tr>
                    <th>Package</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>



    </main>
@endsection

@push('custom-js')
    <script>

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.payment-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{url('api/admin/recent-check-pay-list/list')}}",
                columns: [
                    {data: 'package', name: 'package'},
                    {data: 'price', name: 'price'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
