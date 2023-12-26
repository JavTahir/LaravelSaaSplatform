function confirmDelete(deleteUrl) {
    if (confirm("Are you sure you want to delete this user?")) {
        window.location.href = deleteUrl;
    }
}
