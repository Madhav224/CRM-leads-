<!-- Edit Modal -->
                            <div class="modal fade" id="editStatusModal{{ $status->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('statuses.update', $status->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Name</label>
                                                    <input type="text" name="name" value="{{ $status->name }}" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Color</label>
                                                    <input type="text" name="color" value="{{ $status->color }}" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
