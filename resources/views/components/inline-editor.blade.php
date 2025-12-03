<!-- Inline Editable Field Component -->
<div class="editable-field-wrapper mb-3" id="{{ $htmlId }}-wrapper" data-field-name="{{ $fieldName }}">
    <div class="d-flex justify-content-between align-items-start">
        <div class="flex-grow-1">
            <label class="form-label text-muted small">{{ $label }}</label>
            <div id="{{ $htmlId }}-preview" class="editable-preview p-2 bg-light border rounded">
                @if($type === 'textarea')
                    <pre style="white-space: pre-wrap; margin: 0;">{{ $value ?: '(empty)' }}</pre>
                @elseif($type === 'url')
                    <a href="{{ $value }}" target="_blank" rel="noopener noreferrer">{{ $value ?: '(empty)' }}</a>
                @else
                    <span>{{ $value ?: '(empty)' }}</span>
                @endif
            </div>
        </div>
        <button class="btn btn-sm btn-outline-primary edit-btn-inline ms-2" 
                id="{{ $btnId }}"
                data-field-name="{{ $fieldName }}"
                data-field-type="{{ $type }}"
                data-field-label="{{ $label }}"
                onclick="editField(this)">
            <i class="fas fa-edit"></i> Edit
        </button>
    </div>

    <!-- Hidden Edit Form -->
    <div id="{{ $htmlId }}-form" class="editable-form mt-2" style="display: none;">
        @if($type === 'textarea')
            <textarea class="form-control editable-input" 
                      data-field-name="{{ $fieldName }}"
                      placeholder="{{ $placeholder }}"
                      rows="{{ $rows ?? 3 }}">{{ $value }}</textarea>
        @elseif($type === 'number')
            <input type="number" class="form-control editable-input" 
                   data-field-name="{{ $fieldName }}"
                   placeholder="{{ $placeholder }}"
                   value="{{ $value }}">
        @elseif($type === 'email')
            <input type="email" class="form-control editable-input" 
                   data-field-name="{{ $fieldName }}"
                   placeholder="{{ $placeholder }}"
                   value="{{ $value }}">
        @elseif($type === 'url')
            <input type="url" class="form-control editable-input" 
                   data-field-name="{{ $fieldName }}"
                   placeholder="{{ $placeholder }}"
                   value="{{ $value }}">
        @else
            <input type="text" class="form-control editable-input" 
                   data-field-name="{{ $fieldName }}"
                   placeholder="{{ $placeholder }}"
                   value="{{ $value }}">
        @endif
        
        <div class="mt-2 d-flex gap-2">
            <button class="btn btn-sm btn-success save-btn-inline" 
                    onclick="saveField(this)">
                <i class="fas fa-check"></i> Save
            </button>
            <button class="btn btn-sm btn-secondary" 
                    onclick="cancelEdit(this)">
                <i class="fas fa-times"></i> Cancel
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editField(btn) {
    const wrapper = btn.closest('.editable-field-wrapper');
    const formDiv = wrapper.querySelector('.editable-form');
    const previewDiv = wrapper.querySelector('.editable-preview');
    
    previewDiv.style.display = 'none';
    btn.style.display = 'none';
    formDiv.style.display = 'block';
    
    // Focus on input
    const input = formDiv.querySelector('.editable-input');
    input.focus();
    input.select();
}

function cancelEdit(btn) {
    const wrapper = btn.closest('.editable-field-wrapper');
    const formDiv = wrapper.querySelector('.editable-form');
    const previewDiv = wrapper.querySelector('.editable-preview');
    const editBtn = wrapper.querySelector('.edit-btn-inline');
    
    formDiv.style.display = 'none';
    previewDiv.style.display = 'block';
    editBtn.style.display = 'block';
}

async function saveField(btn) {
    const wrapper = btn.closest('.editable-field-wrapper');
    const input = wrapper.querySelector('.editable-input');
    const fieldName = input.getAttribute('data-field-name');
    const value = input.value.trim();
    const previewDiv = wrapper.querySelector('.editable-preview');
    const editBtn = wrapper.querySelector('.edit-btn-inline');
    const formDiv = wrapper.querySelector('.editable-form');
    
    if (!value && fieldName !== 'optional_field') {
        alert('Field tidak boleh kosong');
        return;
    }
    
    // Show loading state
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    
    try {
        // Get the current page route to determine endpoint
        const currentRoute = window.location.pathname;
        const updateUrl = currentRoute.replace(/\/(edit|show)/, '') + '/inline-update';
        
        const response = await fetch(updateUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                field: fieldName,
                value: value
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update preview
            if (input.type === 'textarea') {
                previewDiv.innerHTML = `<pre style="white-space: pre-wrap; margin: 0;">${escapeHtml(value)}</pre>`;
            } else if (input.type === 'url') {
                previewDiv.innerHTML = `<a href="${escapeHtml(value)}" target="_blank" rel="noopener noreferrer">${escapeHtml(value)}</a>`;
            } else {
                previewDiv.innerHTML = `<span>${escapeHtml(value)}</span>`;
            }
            
            // Hide form, show preview
            formDiv.style.display = 'none';
            previewDiv.style.display = 'block';
            editBtn.style.display = 'block';
            
            // Show success message
            showNotification('Field updated successfully', 'success');
        } else {
            showNotification(data.message || 'Error updating field', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Error updating field: ' + error.message, 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-check"></i> Save';
    }
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function showNotification(message, type = 'info') {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    const container = document.querySelector('.container') || document.body;
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = alertHtml;
    container.insertBefore(tempDiv.firstElementChild, container.firstChild);
    
    setTimeout(() => {
        const alert = container.querySelector('.alert');
        if (alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 3000);
}
</script>
@endpush

@push('styles')
<style>
.editable-field-wrapper {
    position: relative;
}

.editable-preview {
    cursor: pointer;
    transition: background-color 0.2s;
    min-height: 38px;
    display: flex;
    align-items: center;
}

.editable-preview:hover {
    background-color: #e9ecef !important;
}

.edit-btn-inline {
    white-space: nowrap;
}

.editable-form textarea.form-control,
.editable-form input.form-control {
    border: 2px solid #0d6efd;
}

.editable-form .btn {
    width: auto;
    min-width: 80px;
}
</style>
@endpush
