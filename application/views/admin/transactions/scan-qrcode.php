<style media="screen">
    #buttonScan {
        padding: 1rem 2.4rem;
        font-size: .94rem;
        display: none;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content" id="demo-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Scan Order Confirmation</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="sourceSelectPanel" style="display:none">
                                <label for="sourceSelect">Change video source:</label>
                                <select id="sourceSelect" style="max-width:450px;" class="form-control"></select>
                            </div>
                            <div>
                                <video id="video" width="450" height="400" style="border: 0px solid gray"></video>
                            </div>
                            <textarea hidden id="result" name="transaction_code" readonly></textarea>
                            <span>
                                <a class="button" id="buttonScan">Scan</a>
                                <!-- <a class="button btn btn-warning" id="resetButton">Reset</a> -->
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ajax-content" id="showResult">

                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/zxing/zxing.min.js'); ?>"></script>
<script type="text/javascript">
    window.addEventListener('load', function() {
        let selectedDeviceId;
        let audio = new Audio("<?= base_url('assets/audio/beep.mp3'); ?>");
        const codeReader = new ZXing.BrowserMultiFormatReader()
        console.log('ZXing code reader initialized')
        codeReader.getVideoInputDevices()
            .then((videoInputDevices) => {
                const sourceSelect = document.getElementById('sourceSelect')
                selectedDeviceId = videoInputDevices[0].deviceId
                if (videoInputDevices.length >= 1) {
                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option')
                        sourceOption.text = element.label
                        sourceOption.value = element.deviceId
                        sourceSelect.appendChild(sourceOption)
                    })
                    sourceSelect.onchange = () => {
                        selectedDeviceId = sourceSelect.value;
                    };
                    const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                    sourceSelectPanel.style.display = 'block'
                }
                codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                    if (result) {
                        console.log(result)
                        document.getElementById('result').textContent = result.text
                        audio.play();
                        $(document).ready(function() {
                            document.getElementById('buttonScan').click();
                        });
                    }

                    if (err && !(err instanceof ZXing.NotFoundException)) {
                        console.error(err)
                        document.getElementById('result').textContent = err
                    }
                });

                console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
                document.getElementById('resetButton').addEventListener('click', () => {
                    codeReader.reset()
                    document.getElementById('result').textContent = '';
                    console.log('Reset.')
                })
            })
            .catch((err) => {
                console.error(err)
            })
    })
</script>
<script>
    let page = '<?= base_url('') ?>';
</script>
<script>
    $("#buttonScan").click(function() {

        let code = $('#result').val();
        console.log(code);
        let url = (page, 'transactions/scanningprocess');
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                code: code,
            },
            beforeSend: function(msg) {
                $('#showResult').html('<h1><i class="fa fa-spin fa-refresh" /></h1>')
            },
            success: function(msg) {
                $('#showResult').html(msg);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('error');
            }
        });

    });
</script>