<!-- Filter Modal -->
<div class="modal fade" id="announcementFilterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your filter/search input fields here -->
                {{-- <div class="form-group">
                    <label for="staffNameFilter">Staff Name</label>
                    <input type="text" class="form-control" id="staffNameFilter">
                </div> --}}
                <div class="form-group">
                    <label for="staffIdFilter">Date<span style="color: red; margin-left: 2px;">*</span></label>
                    <input type="date" class="form-control" id="staffIdFilter" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
</div>
