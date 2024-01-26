</main>

<div class="container-fluid">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <svg class="bi" width="30" height="24">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#twitter"></use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#instagram"></use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#facebook"></use>
                    </svg></a></li>
        </ul>
    </footer>
</div>

<!-- Bootstrap JS -->
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- FONT AWESOME -->
<script src="https://kit.fontawesome.com/e97f5aa83d.js" crossorigin="anonymous"></script>

<!-- Tempus Dominus -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- ALERT JS -->
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<!-- Datepicker: Add -->
<script>
    $(document).ready(function() {
        $('#tglAgendaAdd').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>

<!-- Datepicker: Edit -->
<?php foreach ($agenda as $key => $value) { ?>
    <script>
        $(document).ready(function() {
            $('#tglAgendaEdit<?= $value['id_agenda'] ?>').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });
    </script>
<?php } ?>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen input file
        var fileInput = document.getElementById('file');

        // Ambil nilai placeholder dari data-placeholder dan tetapkan ke input file
        var placeholderValue = fileInput.getAttribute('data-placeholder');
        fileInput.setAttribute('placeholder', placeholderValue);
    });
</script>

<script>
    // Mendapatkan elemen input berdasarkan id
    var inputTahun = document.getElementById('tahun');

    // Mendapatkan tahun saat ini
    var tahunSaatIni = new Date().getFullYear();

    // Mengisi nilai tahun ke dalam elemen input
    inputTahun.value = tahunSaatIni;
</script>

<script type="text/javascript">
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('li a');
    const menuLength = menuItem.length
    for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].className = "nav-link active"
        }
    }
</script>

<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#main_image').change(function() {
        bacaGambar(this);
    })
</script>

<script>
    function bacaGambar1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#foto1').change(function() {
        bacaGambar1(this);
    })
</script>

<script>
    function bacaGambar2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#foto2').change(function() {
        bacaGambar2(this);
    })
</script>

<script>
    function bacaGambar3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load3').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#foto3').change(function() {
        bacaGambar3(this);
    })
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/659b7ee60ff6374032bd88cc/1hjjmfdsj';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->

</html>