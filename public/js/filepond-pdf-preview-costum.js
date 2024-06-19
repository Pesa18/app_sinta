setTimeout(function () {
    // Pastikan FilePond sudah dimuat dengan benar di sini
    FilePond.registerPlugin(FilePondPluginPdfPreview);

    FilePond.setOptions({
        allowPdfPreview: true,
        pdfPreviewHeight: 900,
        pdfComponentExtraParams: "toolbar=0&view=fit&page=1",
    });
}, 1000); // Menggunakan timeout misalnya 1000 ms (1 detik)
