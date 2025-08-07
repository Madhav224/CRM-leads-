

<?php $__env->startSection('title', 'leads page'); ?>


<?php $__env->startSection('content'); ?>
<style>
    .modal.show#addStatusModal {
    z-index: 1060; /* higher than Bootstrap’s default 1055 */
    }

    <style>
    .pagination li a.page-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
</style>
<!-- Action Bar -->
<div class="app-content content">
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
<div class="content-header row"></div>
<div class="content-body">

<div class="card">
    <div class="card-body">
        <div class="row g-3 align-items-center">

            <div class="col-md-6">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-primary" onclick="showAddModal()">
                        <i class="bi bi-plus-circle me-1"></i> Add Lead
                    </button>
                    <button class="btn btn-primary" onclick="">
                        <i class="bi bi-arrow-clockwise me-1"></i> Show Leads
                    </button>
                    <a href="<?php echo e(route('leads.kanban')); ?>" class="btn btn-primary text-white"><i class="bi bi-kanban me-1"></i> Kanban View</a>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-1">
                    <form id="perPageForm" method="GET" class="d-flex align-items-center ">
                    
                    <select name="per_page" id="perPage" class="form-select" style="width: auto; padding-right:25px;" onchange="document.getElementById('perPageForm').submit();">
                        <option value="10" <?php echo e(request('per_page') == 10 ? 'selected' : ''); ?>>10</option>
                        <option value="20" <?php echo e(request('per_page') == 20 ? 'selected' : ''); ?>>20</option>
                        <option value="50" <?php echo e(request('per_page') == 50 ? 'selected' : ''); ?>>50</option>
                        <option value="100" <?php echo e(request('per_page') == 100 ? 'selected' : ''); ?>>100</option>
                    </select>
                </form>
                    <div class="btn-group btn-group-sm ">
                        <button class="btn " style="background-color: #e0e0e06b" onclick="filterByDate('<?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>')">Today</button>
                        <button class="btn "  style="background-color: #e0e0e06b" onclick="filterByDate('<?php echo e(\Carbon\Carbon::tomorrow()->format('Y-m-d')); ?>')">Tomorrow</button>
                        <button class="btn  bg-black text-white" onclick="window.location='<?php echo e(route('leads.index')); ?>'">Reset Filter</button>
                    </div>
                 <input type="date" class="form-control" id="dateFilter" style="width: auto;"
                      onchange="filterByDate(this.value)">
                      
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                   <select class="form-select" id="statusFilter" style="width: auto;" onchange="filterByStatus()" name="status_id">
                        <option value="">All Statuses</option>
                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status->id); ?>" <?php echo e(request()->route('status_id') == $status->id ? 'selected' : ''); ?>>
                                <?php echo e($status->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button class="btn  bg-black text-white" data-bs-toggle="modal" data-bs-target="#manageStatusModal">
                      <i class="bi bi-boxes"></i> Manage Statuses
                   </button>

                </div>
                <div class="d-flex flex-wrap gap-2 justify-content-md-end mt-1">
                    <div class="input-group " style="width: 250px;">
                <input type="text" class="form-control" placeholder="Search leads..." id="searchInput">
            </div>
                </div>
           </div>

        </div>
    </div>

</div>
<!-- Table View -->
<div class="card" id="tableView">
    <div class="card-header d-flex justify-content-between align-items-center">
        

        <div class="d-flex align-items-center ">
              <span class="">
                      <?php if(request()->routeIs('leads.filter-date')): ?>
                          <p class="text-muted">Filtered by: <strong><?php echo e(\Carbon\Carbon::parse(request()->route('date'))->format('d/m/Y')); ?></strong></p>
                      <?php endif; ?>
                 </span>

                 <?php if(request()->routeIs('leads.filter-status')): ?>
                        <?php
                            $filteredStatus = $statuses->firstWhere('id', request()->route('status_id'));
                        ?>
                        <p class="text-muted">
                            Filtered by status: <strong><?php echo e($filteredStatus->name ?? 'Unknown'); ?></strong>
                        </p>
                    <?php endif; ?>
        </div>
                     
       
    </div>


    <div class="card-body">
        <div class="table-responsive" id="leadsContainer">
            <div id="leadsTable">
            <?php echo $__env->make('leads.partials.table', ['leads' => $leads], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        
                    <div class="d-flex justify-content-end mt-2">
                            <?php echo e($leads->links()); ?>

                    </div>
    </div>
</div>






<!-- New Interaction Modal -->
<div class="modal fade" id="interactionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="interactionForm" method="POST" action="<?php echo e(route('leads.updateInteraction')); ?>">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="lead_id" id="interaction_lead_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Interaction</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Followup Date</label>
            <input type="date" class="form-control" name="followup_date" id="interaction_date" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="status_id" id="interaction_status_id" required>
              <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Call Status</label>
            <select class="form-select" name="call_status" id="interaction_call_status" required>
              <option value="Pending">Pending</option>
              <option value="Completed">Completed</option>
              <option value="Scheduled">Scheduled</option>
              <option value="Not Reached">Not Reached</option>
              <option value="In Progress">In Progress</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>





<div class="modal fade" id="leadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add New Lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
<form id="leadForm" method="POST" action="<?php echo e(route('leads.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Customer</label>
            <input type="text" name="customer" class="form-control" required>
        </div>
       <div class="col-md-6">
                <label class="form-label">Product / Service</label>
                <select name="product_id" class="form-select" id="productSelect" onchange="handleProductChange(this)">
                    <option value="">-Select Product/Service-</option>
                    <option value="__add_pro__">+ Add Product</option>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product->id); ?>">
                            <?php echo e($product->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
       </div>
        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select class="form-select" name="status_id" id="statusSelect" onchange="handleStatusChange(this)">
                    <option value="__add_new__">+ Add New</option>
                
                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status->id); ?>" <?php echo e($index === 0 ? 'selected' : ''); ?>>
                        <?php echo e($status->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Source</label>
            <input type="text" name="source" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Number</label>
            <input type="text" name="number" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Followup Date</label>
            <input type="date" name="followup_date" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Next Action</label>
            <input type="text" name="next_action" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Call Status</label>
            <select class="form-select" name="call_status">
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
                <option value="Scheduled">Scheduled</option>
                <option value="Not Reached">Not Reached</option>
                <option value="In Progress">In Progress</option>
            </select>
        </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-primary" >Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
    </div>
    
</form> 

            </div>
        </div>
    </div>
</div>



<!-- Manage Status Modal -->
<div class="modal fade" id="manageStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Add New Status Button -->
                <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addStatusModal">
                    + Add New Status
                </button>

                <!-- Status Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($status->name); ?></td>
                                <td>
                                    <span class="badge" style="background-color: <?php echo e($status->color); ?>"><?php echo e($status->color); ?></span>
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <button 
    class="btn btn-sm btn-warning edit-status-btn" 
    data-id="<?php echo e($status->id); ?>"
    data-name="<?php echo e($status->name); ?>"
    data-color="<?php echo e($status->color); ?>"
    data-action="<?php echo e(route('statuses.update', $status->id)); ?>"
    data-bs-toggle="modal" 
    data-bs-target="#editStatusModal">
    Edit
</button>


                                    <!-- Delete Form -->
                                    <form method="POST" action="<?php echo e(route('statuses.destroy', $status->id)); ?>" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this status?')">Delete</button>
                                    </form>
                                </td>
                            </tr>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Reusable Edit Status Modal -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="editStatusForm">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Status Name</label>
                        <input type="text" name="name" id="editStatusName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Color</label>
                        <input type="text" name="color" id="editStatusColor" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Add Status Modal -->
<div class="modal fade" id="addStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="<?php echo e(route('statuses.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Status Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Color (hex or Bootstrap color name)</label>
                        <input type="text" name="color" class="form-control" required placeholder="#28a745 or red">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal"  >Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="<?php echo e(route('products.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal"  >Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>




</div>
</div>
</div>


<script>
    function filterByDate(selectedDate) {
        if (selectedDate) {
            window.location.href = "<?php echo e(url('/leads/filter-date')); ?>/" + selectedDate;
        }
    }
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll('.edit-status-btn');
    const editForm = document.getElementById('editStatusForm');
    const nameInput = document.getElementById('editStatusName');
    const colorInput = document.getElementById('editStatusColor');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const name = this.getAttribute('data-name');
            const color = this.getAttribute('data-color');
            const action = this.getAttribute('data-action');

            nameInput.value = name;
            colorInput.value = color;
            editForm.action = action;
        });
    });
});
</script>



<script>
     // Show add modal
    function showAddModal() {
        currentEditId = null;
        document.getElementById('modalTitle').textContent = 'Add New Lead';
        document.getElementById('leadForm').reset();
        new bootstrap.Modal(document.getElementById('leadModal')).show();
    }

  
    
</script>


<script>
    function handleStatusChange(select) {
        if (select.value === '__add_new__') {
            select.value = ""; // reset select
            const modal = new bootstrap.Modal(document.getElementById('addStatusModal'));
            modal.show();
        }
    }

     function handleProductChange(select) {
        if (select.value === '__add_pro__') {
            select.value = ""; // reset select
            const modal = new bootstrap.Modal(document.getElementById('addProductModal'));
            modal.show();
        }
    }

</script>


<script>
  function openInteractionModal(leadId, date, statusId, callStatus) {
    document.getElementById('interaction_lead_id').value = leadId;
    document.getElementById('interaction_date').value = date;
    document.getElementById('interaction_status_id').value = statusId;
    document.getElementById('interaction_call_status').value = callStatus;

    const modal = new bootstrap.Modal(document.getElementById('interactionModal'));
    modal.show();
  }
</script>

<script>
function editLead(id) {
    // Use AJAX or populate modal fields manually
    // Example:
    fetch(`/leads/${id}/edit`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('leadForm').action = `/leads/${id}`;
            document.getElementById('modalTitle').innerText = "Edit Lead";
            document.querySelector('input[name="customer"]').value = data.customer;
            document.querySelector('input[name="product"]').value = data.product;
            // ... set all other fields

            // Show the modal
            const leadModal = new bootstrap.Modal(document.getElementById('leadModal'));
            leadModal.show();


        });
}
</script>


<script>
    function filterByStatus() {
        const statusId = document.getElementById('statusFilter').value;
        const baseUrl = "<?php echo e(url('/leads/filter-status')); ?>";
        
        if (statusId) {
            window.location.href = `${baseUrl}/${statusId}`;
        } else {
            window.location.href = "<?php echo e(route('leads.index')); ?>";
        }
    }
</script>


<script>
    let timeout = null;

   document.getElementById('searchInput').addEventListener('keyup', function () {
    clearTimeout(window.liveSearchTimer);
    const query = this.value;

    window.liveSearchTimer = setTimeout(() => {
        fetch(`/leads/live-search?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error ${response.status}`);
                return response.text();
            })
            .then(html => {
                document.getElementById('leadsTable').innerHTML = html;
            })
            .catch(error => {
                console.error('Live search error:', error);
            });
    }, 300);
});

</script>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CRM-1\resources\views/leads/index.blade.php ENDPATH**/ ?>