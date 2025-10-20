@extends('layouts.backend.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Header Card -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Question Management</h5>
      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createQuestionModal">
        <i class="bx bx-plus me-1"></i>Create Question
      </button>
    </div>
  </div>

  <!-- Category Tabs -->
  <div class="card mt-3">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" id="categoryTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="akpol-tab" data-bs-toggle="tab" data-bs-target="#akpol" type="button" role="tab">
            <i class="bx bx-shield me-1"></i>AKPOL
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="bintara-tab" data-bs-toggle="tab" data-bs-target="#bintara" type="button" role="tab">
            <i class="bx bx-user me-1"></i>BINTARA
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tamtama-tab" data-bs-toggle="tab" data-bs-target="#tamtama" type="button" role="tab">
            <i class="bx bx-group me-1"></i>TAMTAMA
          </button>
        </li>
      </ul>
    </div>

    <div class="tab-content" id="categoryTabsContent">
      <!-- AKPOL Tab -->
      <div class="tab-pane fade show active" id="akpol" role="tabpanel">
        <div class="card-body">
          <!-- Section Tabs for AKPOL -->
          <ul class="nav nav-pills mb-3" id="akpolSectionTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="akpol-akademik-tab" data-bs-toggle="pill" data-bs-target="#akpol-akademik" type="button" role="tab">
                <i class="bx bx-book me-1"></i>AKADEMIK
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="akpol-kecermatan-tab" data-bs-toggle="pill" data-bs-target="#akpol-kecermatan" type="button" role="tab">
                <i class="bx bx-target-lock me-1"></i>KECERMATAN
              </button>
            </li>
          </ul>

          <div class="tab-content" id="akpolSectionTabsContent">
            <!-- AKPOL AKADEMIK -->
            <div class="tab-pane fade show active" id="akpol-akademik" role="tabpanel">
              <div class="table-responsive">
                <table class="table table-hover" id="akpol-akademik-table">
                  <thead class="table-dark">
                    <tr>
                      <th>No</th>
                      <th>Test Type</th>
                      <th>Subject</th>
                      <th>Question</th>
                      <th>Image</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $akpolAkademikQuestions = $questions->filter(function($question) {
                        return $question->examSubject->examType->testCategory->id == 1 &&
                               $question->examSubject->examType->section == 'AKADEMIK';
                      });
                    @endphp
                    @foreach($akpolAkademikQuestions as $index => $question)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td><span class="badge bg-primary">{{ $question->examSubject->examType->name }}</span></td>
                      <td><span class="badge bg-info">{{ $question->examSubject->name }}</span></td>
                      <td>{{ Str::limit($question->question, 50) }}</td>
                      <td>
                        @if($question->image)
                          <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                        @else
                          <span class="text-muted">No image</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('answers.index', $question->id) }}" class="btn btn-info btn-sm" title="View Answers">
                          <i class="bx bx-list-ul"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editQuestionModal"
                                onclick="editQuestion({{ $question->id }}, {{ $question->examSubject->examType->testCategory->id }}, '{{ $question->examSubject->examType->section }}', '{{ $question->examSubject->examType->name }}', '{{ $question->examSubject->name }}', '{{ addslashes($question->question) }}')">
                          <i class="bx bx-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteQuestion({{ $question->id }})">
                          <i class="bx bx-trash"></i>
                        </button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <!-- AKPOL KECERMATAN -->
            <div class="tab-pane fade" id="akpol-kecermatan" role="tabpanel">
              <div class="table-responsive">
                <table class="table table-hover" id="akpol-kecermatan-table">
                  <thead class="table-dark">
                    <tr>
                      <th>No</th>
                      <th>Test Type</th>
                      <th>Subject</th>
                      <th>Question</th>
                      <th>Actions</th>
          </tr>
        </thead>
        <tbody>
                    @php
                      $akpolKecermatanQuestions = $questions->filter(function($question) {
                        return $question->examSubject->examType->testCategory->id == 1 &&
                               $question->examSubject->examType->section == 'KECERMATAN';
                      });
                    @endphp
                    @foreach($akpolKecermatanQuestions as $index => $question)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td><span class="badge bg-success">{{ $question->examSubject->examType->name }}</span></td>
                      <td><span class="badge bg-warning">{{ $question->examSubject->name }}</span></td>
                      <td>{{ Str::limit($question->question, 50) }}</td>
                      <td>
                        <a href="{{ route('answers.index', $question->id) }}" class="btn btn-info btn-sm" title="View Answers">
                          <i class="bx bx-list-ul"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editQuestionModal"
                                onclick="editQuestion({{ $question->id }}, {{ $question->examSubject->examType->testCategory->id }}, '{{ $question->examSubject->examType->section }}', '{{ $question->examSubject->examType->name }}', '{{ $question->examSubject->name }}', '{{ addslashes($question->question) }}')">
                          <i class="bx bx-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteQuestion({{ $question->id }})">
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
      </div>

      <!-- BINTARA Tab -->
      <div class="tab-pane fade" id="bintara" role="tabpanel">
        <div class="card-body">
          <!-- Section Tabs for BINTARA -->
          <ul class="nav nav-pills mb-3" id="bintaraSectionTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="bintara-akademik-tab" data-bs-toggle="pill" data-bs-target="#bintara-akademik" type="button" role="tab">
                <i class="bx bx-book me-1"></i>AKADEMIK
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="bintara-kecermatan-tab" data-bs-toggle="pill" data-bs-target="#bintara-kecermatan" type="button" role="tab">
                <i class="bx bx-target-lock me-1"></i>KECERMATAN
              </button>
            </li>
          </ul>

          <div class="tab-content" id="bintaraSectionTabsContent">
            <!-- BINTARA AKADEMIK -->
            <div class="tab-pane fade show active" id="bintara-akademik" role="tabpanel">
              <div class="table-responsive">
                <table class="table table-hover" id="bintara-akademik-table">
                  <thead class="table-dark">
                    <tr>
                      <th>No</th>
                      <th>Test Type</th>
                      <th>Subject</th>
                      <th>Question</th>
                      <th>Image</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $bintaraAkademikQuestions = $questions->filter(function($question) {
                        return $question->examSubject->examType->testCategory->id == 2 &&
                               $question->examSubject->examType->section == 'AKADEMIK';
                      });
                    @endphp
                    @foreach($bintaraAkademikQuestions as $index => $question)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td><span class="badge bg-primary">{{ $question->examSubject->examType->name }}</span></td>
                      <td><span class="badge bg-info">{{ $question->examSubject->name }}</span></td>
                      <td>{{ Str::limit($question->question, 50) }}</td>
                      <td>
                        @if($question->image)
                          <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                        @else
                          <span class="text-muted">No image</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('answers.index', $question->id) }}" class="btn btn-info btn-sm" title="View Answers">
                          <i class="bx bx-list-ul"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editQuestionModal"
                                onclick="editQuestion({{ $question->id }}, {{ $question->examSubject->examType->testCategory->id }}, '{{ $question->examSubject->examType->section }}', '{{ $question->examSubject->examType->name }}', '{{ $question->examSubject->name }}', '{{ addslashes($question->question) }}')">
                          <i class="bx bx-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteQuestion({{ $question->id }})">
                          <i class="bx bx-trash"></i>
                        </button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <!-- BINTARA KECERMATAN -->
            <div class="tab-pane fade" id="bintara-kecermatan" role="tabpanel">
              <div class="table-responsive">
                <table class="table table-hover" id="bintara-kecermatan-table">
                  <thead class="table-dark">
                    <tr>
                      <th>No</th>
                      <th>Test Type</th>
                      <th>Subject</th>
                      <th>Question</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $bintaraKecermatanQuestions = $questions->filter(function($question) {
                        return $question->examSubject->examType->testCategory->id == 2 &&
                               $question->examSubject->examType->section == 'KECERMATAN';
                      });
                    @endphp
                    @foreach($bintaraKecermatanQuestions as $index => $question)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td><span class="badge bg-success">{{ $question->examSubject->examType->name }}</span></td>
                      <td><span class="badge bg-warning">{{ $question->examSubject->name }}</span></td>
                      <td>{{ Str::limit($question->question, 50) }}</td>
                      <td>
                        <a href="{{ route('answers.index', $question->id) }}" class="btn btn-info btn-sm" title="View Answers">
                          <i class="bx bx-list-ul"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editQuestionModal"
                                onclick="editQuestion({{ $question->id }}, {{ $question->examSubject->examType->testCategory->id }}, '{{ $question->examSubject->examType->section }}', '{{ $question->examSubject->examType->name }}', '{{ $question->examSubject->name }}', '{{ addslashes($question->question) }}')">
                          <i class="bx bx-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteQuestion({{ $question->id }})">
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
      </div>

      <!-- TAMTAMA Tab -->
      <div class="tab-pane fade" id="tamtama" role="tabpanel">
        <div class="card-body">
          <!-- Section Tabs for TAMTAMA -->
          <ul class="nav nav-pills mb-3" id="tamtamaSectionTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="tamtama-akademik-tab" data-bs-toggle="pill" data-bs-target="#tamtama-akademik" type="button" role="tab">
                <i class="bx bx-book me-1"></i>AKADEMIK
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tamtama-kecermatan-tab" data-bs-toggle="pill" data-bs-target="#tamtama-kecermatan" type="button" role="tab">
                <i class="bx bx-target-lock me-1"></i>KECERMATAN
                </button>
            </li>
          </ul>

          <div class="tab-content" id="tamtamaSectionTabsContent">
            <!-- TAMTAMA AKADEMIK -->
            <div class="tab-pane fade show active" id="tamtama-akademik" role="tabpanel">
              <div class="table-responsive">
                <table class="table table-hover" id="tamtama-akademik-table">
                  <thead class="table-dark">
                    <tr>
                      <th>No</th>
                      <th>Test Type</th>
                      <th>Subject</th>
                      <th>Question</th>
                      <th>Image</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $tamtamaAkademikQuestions = $questions->filter(function($question) {
                        return $question->examSubject->examType->testCategory->id == 3 &&
                               $question->examSubject->examType->section == 'AKADEMIK';
                      });
                    @endphp
                    @foreach($tamtamaAkademikQuestions as $index => $question)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td><span class="badge bg-primary">{{ $question->examSubject->examType->name }}</span></td>
                      <td><span class="badge bg-info">{{ $question->examSubject->name }}</span></td>
                      <td>{{ Str::limit($question->question, 50) }}</td>
                      <td>
                        @if($question->image)
                          <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                        @else
                          <span class="text-muted">No image</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('answers.index', $question->id) }}" class="btn btn-info btn-sm" title="View Answers">
                          <i class="bx bx-list-ul"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editQuestionModal"
                                onclick="editQuestion({{ $question->id }}, {{ $question->examSubject->examType->testCategory->id }}, '{{ $question->examSubject->examType->section }}', '{{ $question->examSubject->examType->name }}', '{{ $question->examSubject->name }}', '{{ addslashes($question->question) }}')">
                          <i class="bx bx-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteQuestion({{ $question->id }})">
                          <i class="bx bx-trash"></i>
                        </button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <!-- TAMTAMA KECERMATAN -->
            <div class="tab-pane fade" id="tamtama-kecermatan" role="tabpanel">
              <div class="table-responsive">
                <table class="table table-hover" id="tamtama-kecermatan-table">
                  <thead class="table-dark">
                    <tr>
                      <th>No</th>
                      <th>Test Type</th>
                      <th>Subject</th>
                      <th>Question</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $tamtamaKecermatanQuestions = $questions->filter(function($question) {
                        return $question->examSubject->examType->testCategory->id == 3 &&
                               $question->examSubject->examType->section == 'KECERMATAN';
                      });
                    @endphp
                    @foreach($tamtamaKecermatanQuestions as $index => $question)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td><span class="badge bg-success">{{ $question->examSubject->examType->name }}</span></td>
                      <td><span class="badge bg-warning">{{ $question->examSubject->name }}</span></td>
                      <td>{{ Str::limit($question->question, 50) }}</td>
                      <td>
                        <a href="{{ route('answers.index', $question->id) }}" class="btn btn-info btn-sm" title="View Answers">
                          <i class="bx bx-list-ul"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editQuestionModal"
                                onclick="editQuestion({{ $question->id }}, {{ $question->examSubject->examType->testCategory->id }}, '{{ $question->examSubject->examType->section }}', '{{ $question->examSubject->examType->name }}', '{{ $question->examSubject->name }}', '{{ addslashes($question->question) }}')">
                          <i class="bx bx-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteQuestion({{ $question->id }})">
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
      </div>
    </div>
  </div>
</div>
<!-- / Content -->

<!-- Create Question Modal -->
<div class="modal fade" id="createQuestionModal" tabindex="-1" aria-labelledby="createQuestionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createQuestionModalLabel">Create New Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="create_category" class="form-label">Category <span class="text-danger">*</span></label>
                <select class="form-control @error('category') is-invalid @enderror" id="create_category" name="category" required>
                  <option value="">Select Category</option>
                  <option value="1">AKPOL</option>
                  <option value="2">BINTARA</option>
                  <option value="3">TAMTAMA</option>
                </select>
                @error('category')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
          <div class="mb-3">
                <label for="create_section" class="form-label">Section <span class="text-danger">*</span></label>
                <select class="form-control @error('section') is-invalid @enderror" id="create_section" name="section" required>
                  <option value="">Select Section</option>
                  <option value="AKADEMIK">AKADEMIK</option>
                  <option value="KECERMATAN">KECERMATAN</option>
                </select>
                @error('section')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
          <div class="mb-3">
                <label for="create_test_type" class="form-label">Test Type <span class="text-danger">*</span></label>
                <select class="form-control @error('test_type') is-invalid @enderror" id="create_test_type" name="test_type" required>
                  <option value="">Select Test Type</option>
                  <option value="PRETEST">PRETEST</option>
                  <option value="MIDTEST">MIDTEST</option>
                  <option value="POSTTEST">POSTTEST</option>
                  <option value="TRYOUT">TRYOUT</option>
                </select>
                @error('test_type')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
            </div>
            <div class="col-md-6">
          <div class="mb-3">
                <label for="create_subject" class="form-label">Subject <span class="text-danger">*</span></label>
                <select class="form-control @error('subject') is-invalid @enderror" id="create_subject" name="subject" required>
                  <option value="">Select Subject</option>
                  <!-- Options will be populated by JavaScript based on section -->
            </select>
                @error('subject')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="create_question" class="form-label">Question <span class="text-danger">*</span></label>
            <textarea class="form-control @error('question') is-invalid @enderror" id="create_question" name="question" rows="4" placeholder="Enter your question here..." required>{{ old('question') }}</textarea>
            @error('question')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="create_image" class="form-label">Question Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="create_image" name="image" accept="image/*" onchange="previewImage(this, 'create_image_preview')">
            <div class="form-text">Upload an image for the question (optional). Max size: 2MB. Supported formats: JPEG, PNG, JPG, GIF</div>
            <div id="create_image_preview" class="mt-2" style="display: none;">
              <img id="create_image_preview_img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
            </div>
            @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Question</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Question Modal -->
<div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editQuestionForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="edit_category" class="form-label">Category</label>
                <select class="form-control @error('category') is-invalid @enderror" id="edit_category" name="category">
                  <option value="">Select Category</option>
                  <option value="1">AKPOL</option>
                  <option value="2">BINTARA</option>
                  <option value="3">TAMTAMA</option>
                </select>
                @error('category')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
          <div class="mb-3">
                <label for="edit_section" class="form-label">Section</label>
                <select class="form-control @error('section') is-invalid @enderror" id="edit_section" name="section">
                  <option value="">Select Section</option>
                  <option value="AKADEMIK">AKADEMIK</option>
                  <option value="KECERMATAN">KECERMATAN</option>
                </select>
                @error('section')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
          <div class="mb-3">
                <label for="edit_test_type" class="form-label">Test Type</label>
                <select class="form-control @error('test_type') is-invalid @enderror" id="edit_test_type" name="test_type">
                  <option value="">Select Test Type</option>
                  <option value="PRETEST">PRETEST</option>
                  <option value="MIDTEST">MIDTEST</option>
                  <option value="POSTTEST">POSTTEST</option>
                  <option value="TRYOUT">TRYOUT</option>
                </select>
                @error('test_type')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
            </div>
            <div class="col-md-6">
          <div class="mb-3">
                <label for="edit_subject" class="form-label">Subject</label>
                <select class="form-control @error('subject') is-invalid @enderror" id="edit_subject" name="subject">
                  <option value="">Select Subject</option>
                  <!-- Options will be populated by JavaScript based on section -->
            </select>
                @error('subject')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="edit_question" class="form-label">Question</label>
            <textarea class="form-control @error('question') is-invalid @enderror" id="edit_question" name="question" rows="4" placeholder="Enter your question here..."></textarea>
            @error('question')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="edit_image" class="form-label">Question Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="edit_image" name="image" accept="image/*" onchange="previewImage(this, 'edit_image_preview')">
            <div class="form-text">Upload an image for the question (optional). Max size: 2MB. Supported formats: JPEG, PNG, JPG, GIF</div>
            <div id="edit_image_preview" class="mt-2" style="display: none;">
              <img id="edit_image_preview_img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
            </div>
            @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Question</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Subject options based on section
const subjectOptions = {
  'AKADEMIK': [
    { value: 'B.IND', text: 'B.IND' },
    { value: 'PN', text: 'PN' },
    { value: 'BING', text: 'BING' },
    { value: 'PU', text: 'PU' },
    { value: 'TWK', text: 'TWK' }
  ],
  'KECERMATAN': [
    { value: 'KECERMATAN', text: 'KECERMATAN' },
  ]
};

// Function to update subject options based on section
function updateSubjectOptions(sectionSelectId, subjectSelectId) {
  const sectionSelect = document.getElementById(sectionSelectId);
  const subjectSelect = document.getElementById(subjectSelectId);

  // Clear existing options
  subjectSelect.innerHTML = '<option value="">Select Subject</option>';

  if (sectionSelect.value && subjectOptions[sectionSelect.value]) {
    subjectOptions[sectionSelect.value].forEach(option => {
      const optionElement = document.createElement('option');
      optionElement.value = option.value;
      optionElement.textContent = option.text;
      subjectSelect.appendChild(optionElement);
    });
  }
}

// Add event listeners for section changes
document.addEventListener('DOMContentLoaded', function() {
  // Create modal section change
  const createSectionSelect = document.getElementById('create_section');
  if (createSectionSelect) {
    createSectionSelect.addEventListener('change', function() {
      updateSubjectOptions('create_section', 'create_subject');
    });
  }

  // Edit modal section change
  const editSectionSelect = document.getElementById('edit_section');
  if (editSectionSelect) {
    editSectionSelect.addEventListener('change', function() {
      updateSubjectOptions('edit_section', 'edit_subject');
    });
  }

  // Initialize DataTables for all question tables
  initializeDataTables();

  // Add event listeners for tab changes to reinitialize DataTables
  const categoryTabs = document.querySelectorAll('#categoryTabs button[data-bs-toggle="tab"]');
  categoryTabs.forEach(tab => {
    tab.addEventListener('shown.bs.tab', function() {
      reinitializeDataTables();
    });
  });

  // Add event listeners for section tab changes
  const sectionTabs = document.querySelectorAll('[id$="SectionTabs"] button[data-bs-toggle="pill"]');
  sectionTabs.forEach(tab => {
    tab.addEventListener('shown.bs.tab', function() {
      reinitializeDataTables();
    });
  });
});

// Function to initialize DataTables
function initializeDataTables() {
  const tableIds = [
    'akpol-akademik-table',
    'akpol-kecermatan-table',
    'bintara-akademik-table',
    'bintara-kecermatan-table',
    'tamtama-akademik-table',
    'tamtama-kecermatan-table'
  ];

  tableIds.forEach(tableId => {
    const table = document.getElementById(tableId);
    if (table && !$.fn.DataTable.isDataTable('#' + tableId)) {
      try {
        $('#' + tableId).DataTable({
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
          { "orderable": false, "targets": -1 } // Disable sorting on last column (Actions)
        ],
        "order": [[ 0, "asc" ]], // Sort by first column (No)
        "responsive": true,
        "autoWidth": false,
        "deferRender": true, // Defer rendering for better performance
        "processing": false, // Disable processing indicator
        "searching": true,
        "paging": true,
        "info": true
        });
      } catch (error) {
        console.warn('DataTable initialization failed for ' + tableId + ':', error);
        // Continue with other tables even if one fails
      }
    }
  });
}

// Function to reinitialize DataTables when tab changes
function reinitializeDataTables() {
  // Destroy existing DataTables
  const tableIds = [
    'akpol-akademik-table',
    'akpol-kecermatan-table',
    'bintara-akademik-table',
    'bintara-kecermatan-table',
    'tamtama-akademik-table',
    'tamtama-kecermatan-table'
  ];

  tableIds.forEach(tableId => {
    try {
      if ($.fn.DataTable.isDataTable('#' + tableId)) {
        $('#' + tableId).DataTable().destroy();
      }
    } catch (error) {
      console.warn('DataTable destroy failed for ' + tableId + ':', error);
    }
  });

  // Reinitialize after a short delay
  setTimeout(() => {
    initializeDataTables();
  }, 100);
}

// Function to edit question
function editQuestion(id, category, section, testType, subject, question) {
  // Set form action
  document.getElementById('editQuestionForm').action = `/questions/${id}`;

  // Set form values
  document.getElementById('edit_category').value = category;
  document.getElementById('edit_section').value = section;
  document.getElementById('edit_test_type').value = testType;
  document.getElementById('edit_question').value = question;

  // Update subject options based on section
  updateSubjectOptions('edit_section', 'edit_subject');

  // Set subject value after options are loaded
  setTimeout(() => {
    document.getElementById('edit_subject').value = subject;
  }, 100);
}

// Function to delete question
function deleteQuestion(id) {
  if (confirm('Are you sure you want to delete this question?')) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/questions/${id}`;

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
