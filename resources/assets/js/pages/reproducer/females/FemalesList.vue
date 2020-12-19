<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Lista de Reproductoras</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="females" class="table table-striped table-hover table-sm" style="width:100%">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Registro</th>
                      <th>Opciones</th>
                      <th>Condición</th>
                      <th>Eventos</th>
                    </tr>
                  </thead>
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
  import moment from 'moment'
  import permissions from '../../../mixins/permissions'
  export default {
    data(){
      return {
        selected: null
      }
    },
    mixins: [permissions],
    mounted() {
      $(function() {
        let table = $('#females').DataTable({
          language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          },
          responsive: true,
          processing: true,
          serverSide: true,
          order:[[0, 'desc']],
          ajax: {
            url: '/females/list',
            type: 'GET'
          },
          columns: [
            {data: "show", name: 'action', orderable: false, searchable: false},
            {data: "created_at", "render": function ( data, type, full, meta ) {
              return moment(data).format('DD/MM/YYYY');
            }},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: "created_at", "render": function ( data, type, full, meta ) {
              return moment(data).format('DD/MM/YYYY');
            }},
            {data: 'events', name: 'events', orderable: false, searchable: false},
          ],
        });
      })
    }
  }
</script>

