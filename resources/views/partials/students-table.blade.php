<div class="table-box">
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Email</th>
                <th>Username</th>
                <th>Degree</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>
                        <span class="table-title">{{ trim($student->fname . ' ' . $student->mname . ' ' . $student->lname) }}</span>
                        <span class="muted">Student ID {{ $student->id }}</span>
                    </td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->userAccount->username ?? 'No account' }}</td>
                    <td>
                        @if (filled($student->degree?->degree_title))
                            <span class="status-badge">{{ $student->degree->degree_title }}</span>
                        @else
                            <span class="status-badge status-empty">No degree assigned</span>
                        @endif
                    </td>
                    <td>{{ $student->contactno }}</td>
                    <td>
                        <button type="button" class="action-btn view-student-btn" data-id="{{ $student->id }}">View</button>
                        <a href="{{ route('student.edit', $student->id) }}" class="action-btn">Edit</a>
                        <button type="button" class="action-btn delete-btn delete-student-btn" data-id="{{ $student->id }}">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No students available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($students->hasPages())
    <div class="pagination">
        @if ($students->onFirstPage())
            <span class="disabled-page">Previous</span>
        @else
            <a href="{{ $students->previousPageUrl() }}">Previous</a>
        @endif

        @foreach ($students->getUrlRange(1, $students->lastPage()) as $page => $url)
            @if ($page == $students->currentPage())
                <span class="active-page">{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach

        @if ($students->hasMorePages())
            <a href="{{ $students->nextPageUrl() }}">Next</a>
        @else
            <span class="disabled-page">Next</span>
        @endif
    </div>
@endif
