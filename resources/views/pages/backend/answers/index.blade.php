@extends('layouts.backend.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <!-- Header Card -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-0">Answer Management</h5>
        <small class="text-muted">Manage answers for the selected question</small>
      </div>
      <div>
        <a href="{{ route('questions.index') }}" class="btn btn-secondary btn-sm me-2">
          <i class="bx bx-arrow-back me-1"></i>Back to Questions
        </a>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createAnswerModal">
          <i class="bx bx-plus me-1"></i>Add Answer
        </button>
      </div>
    </div>
  </div>

  <!-- Question Information Card -->
  <div class="card mt-3">
    <div class="card-header">
      <h6 class="mb-0">
        <i class="bx bx-info-circle me-2"></i>Question Information
      </h6>
    </div>
    <div class="card-body">
      @if($question)
        <div class="row">
          <div class="col-md-3">
            <strong>Category:</strong>
            <span class="badge bg-primary ms-2">{{ $question->examSubject->examType->testCategory->name }}</span>
          </div>
          <div class="col-md-3">
            <strong>Section:</strong>
            <span class="badge bg-info ms-2">{{ $question->examSubject->examType->section }}</span>
          </div>
          <div class="col-md-3">
            <strong>Test Type:</strong>
            <span class="badge bg-success ms-2">{{ $question->examSubject->examType->name }}</span>
          </div>
          <div class="col-md-3">
            <strong>Subject:</strong>
            <span class="badge bg-warning ms-2">{{ $question->examSubject->name }}</span>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <strong>Question:</strong>
            <div class="mt-2 p-3 bg-light rounded">
              {{ $question->question }}
            </div>
          </div>
        </div>
      @else
        <div class="alert alert-warning">
          <i class="bx bx-error-circle me-2"></i>Question information not found.
        </div>
      @endif
    </div>
  </div>

  <!-- Answers Table -->
  <div class="card mt-3">
    <div class="card-header">
      <h6 class="mb-0">
        <i class="bx bx-list-ul me-2"></i>Answers List
        <span class="badge bg-secondary ms-2">{{ $answers->count() }} answers</span>
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="answersTable">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Answer</th>
              <th>Image</th>
              <th>Is Correct</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($answers as $index => $answer)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $answer->answer }}</td>
              <td>
                @if($answer->image)
                  <img src="{{ asset('storage/' . $answer->image) }}" alt="Answer Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                @else
                  <span class="text-muted">No image</span>
                @endif
              </td>
              <td>
                @if($answer->is_correct)
                  <span class="badge bg-success">
                    <i class="bx bx-check me-1"></i>Correct
                  </span>
                @else
                  <span class="badge bg-secondary">
                    <i class="bx bx-x me-1"></i>Incorrect
                  </span>
                @endif
              </td>
              <td>
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAnswerModal"
                        onclick="editAnswer({{ $answer->id }}, '{{ addslashes($answer->answer) }}', {{ $answer->is_correct ? 'true' : 'false' }})">
                  <i class="bx bx-edit"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="deleteAnswer({{ $answer->id }})">
                  <i class="bx bx-trash"></i>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->

<!-- Create Answer Modal -->
<div class="modal fade" id="createAnswerModal" tabindex="-1" aria-labelledby="createAnswerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createAnswerModalLabel">Add New Answer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('answers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="exam_question_id" value="{{ $id }}">
        <div class="modal-body">
          <div class="mb-3">
            <label for="create_answer" class="form-label">Answer <span class="text-danger">*</span></label>
            <textarea class="form-control @error('answer') is-invalid @enderror" id="create_answer" name="answer" rows="3" placeholder="Enter the answer here..." required>{{ old('answer') }}</textarea>
            @error('answer')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="create_image" class="form-label">Answer Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="create_image" name="image" accept="image/*" onchange="previewImage(this, 'create_image_preview')">
            <div class="form-text">Upload an image for the answer (optional). Max size: 2MB. Supported formats: JPEG, PNG, JPG, GIF</div>
            <div id="create_image_preview" class="mt-2" style="display: none;">
              <img id="create_image_preview_img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
            </div>
            @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="create_is_correct" class="form-label">Is Correct Answer?</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="create_is_correct" name="is_correct" value="1" {{ old('is_correct') ? 'checked' : '' }}>
              <label class="form-check-label" for="create_is_correct">
                This is the correct answer
              </label>
            </div>
            @error('is_correct')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Answer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Answer Modal -->
<div class="modal fade" id="editAnswerModal" tabindex="-1" aria-labelledby="editAnswerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAnswerModalLabel">Edit Answer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editAnswerForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_answer" class="form-label">Answer</label>
            <textarea class="form-control @error('answer') is-invalid @enderror" id="edit_answer" name="answer" rows="3" placeholder="Enter the answer here..."></textarea>
            @error('answer')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="edit_image" class="form-label">Answer Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="edit_image" name="image" accept="image/*" onchange="previewImage(this, 'edit_image_preview')">
            <div class="form-text">Upload an image for the answer (optional). Max size: 2MB. Supported formats: JPEG, PNG, JPG, GIF</div>
            <div id="edit_image_preview" class="mt-2" style="display: none;">
              <img id="edit_image_preview_img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
            </div>
            @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="edit_is_correct" class="form-label">Is Correct Answer?</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="edit_is_correct" name="is_correct" value="1">
              <label class="form-check-label" for="edit_is_correct">
                This is the correct answer
              </label>
            </div>
            @error('is_correct')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Answer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Initialize DataTable
  $('#answersTable').DataTable({
    "pageLength": 10,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "language": {
      "search": "Cari:",
      "lengthMenu": "Tampilkan _MENU_ data per halaman",
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
      "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
      "infoFiltered": "(disaring dari _MAX_ total data)",
      "paginate": {
        "first": "Pertama",
        "last": "Terakhir",
        "next": "Selanjutnya",
        "previous": "Sebelumnya"
      },
      "emptyTable": "Tidak ada data yang tersedia",
      "zeroRecords": "Tidak ditemukan data yang sesuai"
    },
    "columnDefs": [
      { "orderable": false, "targets": 4 } // Disable sorting on Actions column
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
});

// Function to edit answer
function editAnswer(id, answer, isCorrect) {
  // Set form action
  document.getElementById('editAnswerForm').action = `/answers/${id}`;

  // Set form values
  document.getElementById('edit_answer').value = answer;
  document.getElementById('edit_is_correct').checked = isCorrect;
}

// Function to delete answer
function deleteAnswer(id) {
  if (confirm('Are you sure you want to delete this answer?')) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/answers/${id}`;

    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const methodField = document.createElement('input');
    methodField.type = 'hidden';
    methodField.name = '_method';
    methodField.value = 'DELETE';

    form.appendChild(csrfToken);
    form.appendChild(methodField);
    document.body.appendChild(form);
    form.submit();
  }
}

// Function to preview image
function previewImage(input, previewId) {
  const preview = document.getElementById(previewId);
  const previewImg = document.getElementById(previewId + '_img');

  if (input.files && input.files[0]) {
    const reader = new FileReader();

    reader.onload = function(e) {
      previewImg.src = e.target.result;
      preview.style.display = 'block';
    }

    reader.readAsDataURL(input.files[0]);
  } else {
    preview.style.display = 'none';
  }
}
</script>
@endsection
