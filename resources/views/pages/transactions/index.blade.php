@extends('layouts.default')

@section('content')
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Daftar Transaksi Masuk</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pemesan</th>
                                        <th>E-mail</th>
                                        <th>Nomor</th>
                                        <th>Total Transaksi</th>
                                        <th>Status Transaksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->number }}</td>
                                            <td>Rp {{ $item->transaction_total }}</td>
                                            <td>
                                                @if ($item->transaction_status == 'pending')
                                                    <span class="badge badge-warning">
                                                @elseif ($item->transaction_status == 'success')
                                                    <span class="badge badge-success">
                                                @elseif ($item->transaction_status == 'failed')
                                                    <span class="badge badge-danger">
                                                @else
                                                    </span>
                                                @endif
                                                    {{ $item->transaction_status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($item->transaction_status == 'pending')
                                                    <a href="{{ route('transactions.status', $item->id) }}?status=success" class="btn btn-success btn-sm">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                    <a href="{{ route('transactions.status', $item->id) }}?status=failed" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                @endif
                                                <a href="#mymodal" data-remote="{{ route('transactions.show', $item->id) }}" data-toggle="modal" data-target="#mymodal" data-title="Detail Transaksi {{ $item->uuid }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('transactions.edit', $item->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('transactions.destroy', $item->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-5">
                                                Data tidak tersedia
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="my-4 ml-3">{{ $items->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection