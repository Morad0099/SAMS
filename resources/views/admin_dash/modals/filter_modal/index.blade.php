<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="staffIdFilter">Staff ID<span style="color: red; margin-left: 2px;">*</span></label>
                    <input type="text" class="form-control" id="staffIdFilter" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="filterStaff()">Search</button>
            </div>
        </div>
    </div>
</div>
<script>
    function filterStaff() {
        var staffId = $('#staffIdFilter').val();
        // Perform your filtering logic with the staffId
        console.log('Filtering by Staff ID:', staffId);

        // Close the modal if needed
        $('#filterModal').modal('hide');
        $('.modal-backdrop').remove(); // This line removes the backdrop
    }
</script>
