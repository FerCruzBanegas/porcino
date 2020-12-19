<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Lista de Ubicaciones</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-hover table-sm" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Options</th>
                      <th>Events</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Options</th>
                      <th>Events</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import permissions from '../../mixins/permissions'
  export default {
    data(){
      return {
        selected: null
      }
    },
    mixins: [permissions],
    mounted() {
      $(function() {
        var table = $('#example').DataTable({
          language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          },
          responsive: true,
          processing: true,
          serverSide: true,
          order:[[0, 'desc']],
          ajax: {
            url: '/locations/list',
            type: 'GET'
          },
          columns: [
            {data: "show", name: 'action', orderable: false, searchable: false},
            {data: "name"},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: "email"},
            {data: "created_at"},
            {data: 'events', name: 'events', orderable: false, searchable: false},
          ],
        });
      })
    }
  }
</script>

