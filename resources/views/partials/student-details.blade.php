<div class="detail-grid">
    <article class="detail-item">
        <span>Full Name</span>
        <strong>{{ trim($student->fname . ' ' . $student->mname . ' ' . $student->lname) }}</strong>
    </article>
    <article class="detail-item">
        <span>Email</span>
        <strong>{{ $student->email }}</strong>
    </article>
    <article class="detail-item">
        <span>Username</span>
        <strong>{{ $student->userAccount->username ?? 'No account linked' }}</strong>
    </article>
    <article class="detail-item">
        <span>Contact Number</span>
        <strong>{{ $student->contactno }}</strong>
    </article>
    <article class="detail-item">
        <span>Degree</span>
        <strong>{{ filled($student->degree?->degree_title) ? $student->degree->degree_title : 'No degree assigned' }}</strong>
    </article>
</div>
