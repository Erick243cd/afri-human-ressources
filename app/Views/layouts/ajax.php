
<?php if (isset($page) && $page == 'tailly'): ?>
    <script>
        $(document).ready(function () {
            loadEmployeData();

            function loadEmployeData(query) {
                $.ajax({
                    url: "<?= site_url("fetch-employees")?>",
                    method: "POST",
                    data: {query: query},
                    success: function (data) {
                        $("#result-employe").html(data);
                    }
                })
            }

            $("#search_employe").keyup(function () {
                var search = $(this).val();
                if (search != '') {
                    loadEmployeData(search);
                } else {
                    loadEmployeData();
                }
            });
        });
    </script>
<?php endif; ?>
<?php if (isset($page) && $page == 'taillies'): ?>
    <script>
        //Live search and Filter
        loadTaillyData();

        function loadTaillyData(query) {
            let motif = $('#motif_search').val();
            let month = $('#month_search').val();
            $.ajax({
                url: "<?= site_url("fetch-taillies")?>",
                method: "POST",
                data: {query: query, motif: motif, month: month},
                success: function (data) {
                    $("#result-pointages").html(data);
                }
            })
        }

        $("#search_keywords").keyup(() => {
            let search = $("#search_keywords").val();
            if (search !== '') {
                loadTaillyData(search);
            } else {
                loadTaillyData();
            }
        });

        $("#motif_search").change(() => {
            loadTaillyData()
        })

        $("#month_search").change(() => {
            let search = $('#month_search').val();
            if (search !== '') {
                loadTaillyData()
            }
        })
    </script>
<?php endif; ?>
