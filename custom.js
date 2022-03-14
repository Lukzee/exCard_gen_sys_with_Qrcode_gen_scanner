$(document).on('click','#btn',function(){

    var pdf = new jsPDF('p', 'pt', 'a4');

    var pdfName = 'ExamCard.pdf';

    var options = {
        format: 'JPEG',
//                    pagesplit: true,
        "background": '#fff',
    };

    var fullPage = $('body')[0],
        // firstPartPage = $('#part-1')[0],
        firstPartPage = $('.ddprnt'),
        num = firstPartPage.length-1;
        // secondPartPage = $('#part-2')[0];

    for (let i = 0; i < firstPartPage.length; i++) {
        if (i != num) {
            pdf.addHTML(firstPartPage[i], 15, 20, options, function(){ pdf.addPage() });
        } else {
            pdf.addHTML(firstPartPage[i], 15, 20, options, function(){});
        }
    }
    
    // pdf.addHTML(firstPartPage, 15, 20, options, function(){ pdf.addPage() });
    // pdf.addHTML(secondPartPage, 15, 20, options, function(){});

    setTimeout(function() {

//                    pdf.save(pdfName);
        var blob = pdf.output("blob");
        window.open(URL.createObjectURL(blob));

    }, 600);


    
});