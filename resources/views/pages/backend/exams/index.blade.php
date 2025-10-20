@extends('layouts.backend.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Daftar Ujian</h5>
      @if(Auth::user()->role === 'admin')
      <button type="button" class="btn btn-warning btn-sm" onclick="showRegenerateModal()">
        <i class="bx bx-shuffle me-1"></i>Acak Semua Token
      </button>
      @endif
    </div>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Kategori</th>
            <th class="text-white">Jenis Ujian</th>
            <th class="text-white">Section</th>
            <th class="text-white">Subject</th>
            <th class="text-white">Token</th>
            <th class="text-white">Status</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($exams as $exam)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>
              <span class="badge bg-primary">{{ $exam->examType->testCategory->name }}</span>
            </td>
            <td>{{ $exam->examType->name }}</td>
            <td>
              <span class="badge bg-info">{{ $exam->examType->section }}</span>
            </td>
            <td>
              <span class="badge bg-warning">{{ $exam->name }}</span>
            </td>
            <td>
              @if(Auth::user()->role === 'admin')
                {{ $exam->examType->token }}
              @else
                <span style="filter: blur(5px); user-select: none;">{{ $exam->examType->token }}</span>
              @endif
            </td>
            <td>
              @if($exam->examType->status == 'active')
                <span class="badge bg-success">Aktif</span>
              @else
                <span class="badge bg-secondary">Tidak Aktif</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1">
                <!-- Toggle Status Button - Hanya Admin -->
                @if(Auth::user()->role === 'admin')
                  @if($exam->examType->status == 'active')
                    <button type="button" class="btn btn-danger btn-sm" onclick="toggleExamStatus({{ $exam->examType->id }}, 'inactive')" title="Nonaktifkan">
                      <i class="bx bx-x-circle"></i>
                    </button>
                  @else
                    <button type="button" class="btn btn-success btn-sm" onclick="toggleExamStatus({{ $exam->examType->id }}, 'active')" title="Aktifkan">
                      <i class="bx bx-check-circle"></i>
                    </button>
                  @endif
                @endif

                <!-- Exam Button (hanya muncul jika active) -->
                @if($exam->examType->status == 'active')
                  @if($exam->examType->section == 'AKADEMIK')
                    <button type="button" class="btn btn-primary btn-sm" onclick="showTokenModal({{ $exam->id }}, '{{ $exam->examType->token }}', 'AKADEMIK')" title="Ambil Ujian">
                      <i class="bx bx-book"></i>
                    </button>
                  @elseif($exam->examType->section == 'KECERMATAN')
                    <button type="button" class="btn btn-warning btn-sm" onclick="showTokenModal({{ $exam->id }}, '{{ $exam->examType->token }}', 'KECERMATAN')" title="Test Kecermatan">
                      <i class="bx bx-target-lock"></i>
                    </button>
                  @endif
                @endif

                <!-- Lihat Hasil Button -->
                @if(Auth::user()->role === 'admin')
                  <a href="{{ route('exams.admin-results', $exam->id) }}" class="btn btn-info btn-sm" title="Lihat Hasil Semua Peserta">
                    <i class="bx bx-bar-chart-alt-2"></i>
                  </a>
                @else
                  <a href="{{ route('exams.user-results', $exam->id) }}" class="btn btn-info btn-sm" title="Lihat Hasil Saya">
                    <i class="bx bx-bar-chart-alt-2"></i>
                  </a>
                @endif
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->

<!-- Regenerate Token Modal -->
<div class="modal fade" id="regenerateModal" tabindex="-1" aria-labelledby="regenerateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="regenerateModalLabel">
          <i class="bx bx-shuffle me-2"></i>Acak Semua Token
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning" role="alert">
          <i class="bx bx-error-circle me-2"></i>
          <strong>Perhatian!</strong> Tindakan ini akan mengacak ulang semua token ujian.
        </div>
        <p class="mb-2">Dengan mengklik "Ya, Acak Token" maka:</p>
        <ul>
          <li>Semua token ujian akan di-generate ulang secara random</li>
          <li>Token lama tidak akan bisa digunakan lagi</li>
          <li>Anda harus memberitahu token baru kepada peserta</li>
        </ul>
        <p class="text-danger mb-0"><strong>Apakah Anda yakin ingin melanjutkan?</strong></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bx bx-x me-1"></i>Batal
        </button>
        <button type="button" class="btn btn-warning" onclick="regenerateAllTokens()">
          <i class="bx bx-shuffle me-1"></i>Ya, Acak Token
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Token Modal -->
<div class="modal fade" id="tokenModal" tabindex="-1" aria-labelledby="tokenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="tokenModalLabel">
          <i class="bx bx-key me-2"></i>Masukkan Token Ujian
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info" role="alert">
          <i class="bx bx-info-circle me-2"></i>
          Masukkan token yang telah diberikan oleh pengawas untuk memulai ujian.
        </div>
        <div class="mb-3">
          <label for="tokenInput" class="form-label">Token Ujian <span class="text-danger">*</span></label>
          <input type="text" class="form-control form-control-lg" id="tokenInput" placeholder="Masukkan token ujian..." autocomplete="off">
          <div id="tokenError" class="text-danger mt-2" style="display: none;">
            <i class="bx bx-error-circle me-1"></i>
            <span id="tokenErrorMessage"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bx bx-x me-1"></i>Batal
        </button>
        <button type="button" class="btn btn-primary" onclick="validateToken()">
          <i class="bx bx-check me-1"></i>Mulai Ujian
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Token Modal Variables (harus di atas semua)
var currentExamId = null;
var currentExamToken = null;
var currentExamSection = null;

$(document).ready(function() {
    $('#example').DataTable({
        "pageLength": 10,
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
        },
        "columnDefs": [
            { "orderable": false, "targets": 7 } // Disable sorting on Actions column
        ],
        "order": [[ 0, "asc" ]], // Sort by first column (No)
        "responsive": true,
        "autoWidth": false,
        "deferRender": true,
        "processing": false,
        "searching": true,
        "paging": true,
        "info": true
    });

    // Enter key handler
    const tokenInput = document.getElementById('tokenInput');
    if (tokenInput) {
        tokenInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                validateToken();
            }
        });
    }
});

function showTokenModal(examId, examToken, section) {
    currentExamId = examId;
    currentExamToken = examToken;
    currentExamSection = section;

    // Reset modal
    document.getElementById('tokenInput').value = '';
    document.getElementById('tokenError').style.display = 'none';

    // Show modal
    var tokenModal = new bootstrap.Modal(document.getElementById('tokenModal'));
    tokenModal.show();

    // Focus on input
    setTimeout(() => {
        document.getElementById('tokenInput').focus();
    }, 500);
}

function validateToken() {
    const tokenInput = document.getElementById('tokenInput').value.trim();
    const tokenError = document.getElementById('tokenError');
    const tokenErrorMessage = document.getElementById('tokenErrorMessage');

    // Reset error
    tokenError.style.display = 'none';

    // Validate empty
    if (tokenInput === '') {
        tokenErrorMessage.textContent = 'Token tidak boleh kosong!';
        tokenError.style.display = 'block';
        return;
    }

    // Validate token
    if (tokenInput !== currentExamToken) {
        tokenErrorMessage.textContent = 'Token tidak valid! Silakan periksa kembali token Anda.';
        tokenError.style.display = 'block';
        return;
    }

    // Token valid, redirect to exam
    if (currentExamSection === 'AKADEMIK') {
        window.location.href = '{{ url("/exam") }}/' + currentExamId;
    } else if (currentExamSection === 'KECERMATAN') {
        window.location.href = '{{ url("/kecermatan") }}/' + currentExamId;
    }
}

function showRegenerateModal() {
    var regenerateModal = new bootstrap.Modal(document.getElementById('regenerateModal'));
    regenerateModal.show();
}

function regenerateAllTokens() {
    // Show loading
    const btn = event.target;
    const originalHTML = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Mengacak...';

    // Send AJAX request
    fetch('{{ route("exams.regenerate-tokens") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal
            var regenerateModal = bootstrap.Modal.getInstance(document.getElementById('regenerateModal'));
            regenerateModal.hide();

            // Show success alert
            showAlert('success', 'Berhasil!', data.message);

            // Reload page after 1.5 seconds
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showAlert('danger', 'Gagal!', data.message || 'Terjadi kesalahan saat mengacak token.');
            btn.disabled = false;
            btn.innerHTML = originalHTML;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('danger', 'Error!', 'Terjadi kesalahan pada server.');
        btn.disabled = false;
        btn.innerHTML = originalHTML;
    });
}

function showAlert(type, title, message) {
    const alertHTML = `
        <div class="alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; min-width: 400px;" role="alert">
            <strong>${title}</strong> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    document.body.insertAdjacentHTML('afterbegin', alertHTML);

    // Auto remove after 3 seconds
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 3000);
}

function toggleExamStatus(examTypeId, newStatus) {
    // Confirm action
    const action = newStatus === 'active' ? 'mengaktifkan' : 'menonaktifkan';
    if (!confirm(`Apakah Anda yakin ingin ${action} ujian ini?`)) {
        return;
    }

    // Show loading on button
    const btn = event.target.closest('button');
    const originalHTML = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

    // Send AJAX request
    fetch('{{ url("/exams/toggle-status") }}/' + examTypeId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            status: newStatus
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', 'Berhasil!', data.message);

            // Reload page after 1 second
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showAlert('danger', 'Gagal!', data.message || 'Terjadi kesalahan.');
            btn.disabled = false;
            btn.innerHTML = originalHTML;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('danger', 'Error!', 'Terjadi kesalahan pada server.');
        btn.disabled = false;
        btn.innerHTML = originalHTML;
    });
}
</script>

<style>
/* Action Button Hover Effects */
.btn-danger.btn-sm:hover {
  background-color: #dc3545 !important;
  border-color: #dc3545 !important;
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
  transition: all 0.2s ease;
}

.btn-success.btn-sm:hover {
  background-color: #198754 !important;
  border-color: #198754 !important;
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(25, 135, 84, 0.3);
  transition: all 0.2s ease;
}

.btn-primary.btn-sm:hover {
  background-color: #0d6efd !important;
  border-color: #0d6efd !important;
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
  transition: all 0.2s ease;
}

.btn-warning.btn-sm:hover {
  background-color: #ffc107 !important;
  border-color: #ffc107 !important;
  color: #000 !important;
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
  transition: all 0.2s ease;
}

.btn-info.btn-sm:hover {
  background-color: #0dcaf0 !important;
  border-color: #0dcaf0 !important;
  color: #000 !important;
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(13, 202, 240, 0.3);
  transition: all 0.2s ease;
}

/* Icon animation on hover */
.btn-sm:hover i {
  animation: pulse 0.6s ease-in-out;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.2); }
  100% { transform: scale(1); }
}

/* Enhanced tooltip for better visibility */
.btn-sm[title] {
  position: relative;
}

.btn-sm[title]:hover::after {
  content: attr(title);
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%);
  background: #333;
  color: white;
  padding: 6px 10px;
  border-radius: 6px;
  font-size: 12px;
  white-space: nowrap;
  z-index: 1000;
  opacity: 0.95;
  margin-bottom: 5px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.btn-sm[title]:hover::before {
  content: '';
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%);
  border: 5px solid transparent;
  border-top-color: #333;
  z-index: 1000;
}
</style>

@endsection
