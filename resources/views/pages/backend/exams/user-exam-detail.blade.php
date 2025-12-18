@extends('layouts.backend.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-0">Detail Peserta Ujian - {{ $examSubject->name }}</h5>
        <small class="text-muted">{{ $examSubject->examType->testCategory->name }} - {{ $examSubject->examType->name }} ({{ $examSubject->examType->section }})</small>
      </div>
      <a href="{{ route('exams.admin-results', $examSubject->id) }}" class="btn btn-secondary btn-sm">
        <i class="bx bx-arrow-back me-1"></i>Kembali
      </a>
    </div>
    <div class="card-body">
      <!-- Stats Cards -->
      <div class="row mb-4">
        <div class="col-md-3">
          <div class="card bg-primary text-white">
            <div class="card-body text-center">
              <h3 class="mb-0">{{ $users->count() }}</h3>
              <small>Total User</small>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card bg-success text-white">
            <div class="card-body text-center">
              <h3 class="mb-0">{{ $users->where('exam_results_count', '>', 0)->count() }}</h3>
              <small>Sudah Ikut Ujian</small>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card bg-warning text-white">
            <div class="card-body text-center">
              <h3 class="mb-0">{{ $usersNotTaken->count() }}</h3>
              <small>Belum Ikut Ujian</small>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card bg-info text-white">
            <div class="card-body text-center">
              <h3 class="mb-0">{{ $users->sum('exam_results_count') }}</h3>
              <small>Total Pengambilan Ujian</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabs -->
      <ul class="nav nav-tabs mb-3" id="userTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
            Semua User ({{ $users->count() }})
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="taken-tab" data-bs-toggle="tab" data-bs-target="#taken" type="button" role="tab">
            Sudah Ikut ({{ $users->where('exam_results_count', '>', 0)->count() }})
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="not-taken-tab" data-bs-toggle="tab" data-bs-target="#not-taken" type="button" role="tab">
            Belum Ikut ({{ $usersNotTaken->count() }})
          </button>
        </li>
      </ul>

      <!-- Tab Content -->
      <div class="tab-content" id="userTabsContent">
        <!-- All Users Tab -->
        <div class="tab-pane fade show active" id="all" role="tabpanel">
          <div class="table-responsive">
            <table class="table table-hover" id="allUsersTable">
              <thead class="table-dark">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th class="text-center">Jumlah Ujian</th>
                  <th class="text-center">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">
                      {{ ucfirst($user->role) }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-{{ $user->exam_results_count > 0 ? 'success' : 'secondary' }}">
                      {{ $user->exam_results_count }} kali
                    </span>
                  </td>
                  <td class="text-center">
                    @if($user->exam_results_count > 0)
                      <span class="badge bg-success">Sudah Ikut</span>
                    @else
                      <span class="badge bg-warning">Belum Ikut</span>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Taken Tab -->
        <div class="tab-pane fade" id="taken" role="tabpanel">
          <div class="table-responsive">
            <table class="table table-hover" id="takenUsersTable">
              <thead class="table-dark">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th class="text-center">Jumlah Ujian</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users->where('exam_results_count', '>', 0) as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">
                      {{ ucfirst($user->role) }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-success">{{ $user->exam_results_count }} kali</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Not Taken Tab -->
        <div class="tab-pane fade" id="not-taken" role="tabpanel">
          <div class="table-responsive">
            <table class="table table-hover" id="notTakenUsersTable">
              <thead class="table-dark">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th class="text-center">Status</th>
                </tr>
              </thead>
              <tbody>
                @if($usersNotTaken->count() > 0)
                  @foreach($usersNotTaken as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">
                        {{ ucfirst($user->role) }}
                      </span>
                    </td>
                    <td class="text-center">
                      <span class="badge bg-warning">Belum Ikut Ujian</span>
                    </td>
                  </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="5" class="text-center py-4">
                      <i class="bx bx-check-circle text-success" style="font-size: 48px;"></i>
                      <p class="mt-2 text-muted">Semua user sudah mengikuti ujian ini!</p>
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->

<script>
$(document).ready(function() {
    // Initialize DataTables for each table
    $('#allUsersTable').DataTable({
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data yang tersedia",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered": "(disaring dari _MAX_ total data)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        }
    });

    $('#takenUsersTable').DataTable({
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data yang tersedia",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered": "(disaring dari _MAX_ total data)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        }
    });

    $('#notTakenUsersTable').DataTable({
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data yang tersedia",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered": "(disaring dari _MAX_ total data)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        }
    });
});
</script>
@endsection

