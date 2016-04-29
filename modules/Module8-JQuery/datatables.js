$(document).ready(function() {
    $('#countries').DataTable( {
        "order": [[ 2, "asc" ]],
		"pagingType": "full_numbers",
		"pageLength": 20
    } );
} );