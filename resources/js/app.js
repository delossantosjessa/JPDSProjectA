import './bootstrap';

function renderMessage(type, message, errors = []) {
    const container = $('#studentMessage');

    if (!container.length) {
        return;
    }

    if (type === 'error' && errors.length) {
        const list = errors.map((error) => `<li>${error}</li>`).join('');
        container.html(`
            <div class="message message-error">
                <strong>${message}</strong>
                <ul>${list}</ul>
            </div>
        `);
        return;
    }

    const className = type === 'success' ? 'message-success' : 'message-error';
    container.html(`<div class="message ${className}">${message}</div>`);
}

function extractErrors(xhr) {
    if (xhr.responseJSON?.errors) {
        return Object.values(xhr.responseJSON.errors).flat();
    }

    return ['An unexpected error occurred.'];
}

function refreshStudentsTable(html) {
    if (html && $('#studentsTableRegion').length) {
        $('#studentsTableRegion').html(html);
    }
}

function viewStudent(id) {
    $('#studentDetailsCard').hide();

    $.ajax({
        url: `/student/${id}`,
        type: 'GET',
        success(response) {
            $('#studentDetailsTitle').text(response.title || 'Student Details');
            $('#studentDetails').html(response.html);
            $('#studentDetailsCard').show();
        },
        error() {
            renderMessage('error', 'Unable to load student details.');
        },
    });
}

function deleteStudent(id) {
    $.ajax({
        url: `/student/${id}`,
        type: 'DELETE',
        success(response) {
            renderMessage('success', response.message || 'Student deleted successfully.');
            refreshStudentsTable(response.html);
            $('#studentDetailsCard').hide();
        },
        error(xhr) {
            renderMessage('error', 'Unable to delete student.', extractErrors(xhr));
        },
    });
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            Accept: 'application/json',
        },
    });

    $('#saveBtn').on('click', function () {
        $.ajax({
            url: '/student',
            type: 'POST',
            data: {
                fname: $('#fname').val(),
                mname: $('#mname').val(),
                lname: $('#lname').val(),
                email: $('#email').val(),
                username: $('#username').val(),
                password: $('#password').val(),
                password_confirmation: $('#password_confirmation').val(),
                contactno: $('#contactno').val(),
                degree_id: $('#degree_id').val(),
            },
            success(response) {
                renderMessage('success', response.message || 'Student saved successfully.');
                $('#fname').val('');
                $('#mname').val('');
                $('#lname').val('');
                $('#email').val('');
                $('#username').val('');
                $('#password').val('');
                $('#password_confirmation').val('');
                $('#contactno').val('');
                $('#degree_id').val('');
            },
            error(xhr) {
                renderMessage('error', 'Please fix the following errors:', extractErrors(xhr));
            },
        });
    });

    $('#editStudentBtn').on('click', function () {
        const studentId = $('#studentId').val();

        $.ajax({
            url: `/student/${studentId}`,
            type: 'POST',
            data: {
                _method: 'PUT',
                fname: $('#fname').val(),
                mname: $('#mname').val(),
                lname: $('#lname').val(),
                email: $('#email').val(),
                contactno: $('#contactno').val(),
                degree_id: $('#degree_id').val(),
            },
            success(response) {
                renderMessage('success', response.message || 'Student updated successfully.');
                if (response.studentDetailsHtml && $('#studentDetails').length) {
                    $('#studentDetails').html(response.studentDetailsHtml);
                    $('#studentDetailsCard').show();
                }
            },
            error(xhr) {
                renderMessage('error', 'Please fix the following errors:', extractErrors(xhr));
            },
        });
    });

    $(document).on('click', '.view-student-btn', function (e) {
        e.preventDefault();
        viewStudent($(this).data('id'));
    });

    $(document).on('click', '.delete-student-btn', function (e) {
        e.preventDefault();

        if (window.confirm('Delete this student record?')) {
            deleteStudent($(this).data('id'));
        }
    });
});
