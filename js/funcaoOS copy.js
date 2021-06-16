$(document).ready( function () {
   tdiasoff.innerHTML = 0
   var ArrayDiasOff = [];
   var total_dias_off = '0'
    $('#txt_inicio').datepicker({	
        format: "dd/mm/yyyy",	
        language: "pt-BR",
        startDate: '+0d',
    });
    $('#txt_fim').datepicker({	
        format: "dd/mm/yyyy",	
        language: "pt-BR",
        startDate: '+0d',
    });
    $('#txt_dias_off').datepicker({	
        format: "dd/mm/yyyy",	
        language: "pt-BR",
        startDate: '+0d',
        onSelect: function addDiasOff (date) {
            dia_off = $('#txt_dias_off').val();
            inicio = $('#txt_inicio').val();
            fim = $('#txt_fim').val();
            if (dia_off <inicio || dia_off > fim) {
                alert(` Dia off ${date} INVÁLIDO. A data selecionada é menor que o inicio do período ou maior que o término!`);
            } else {
                alert(` Dia off ${date} adicionado com sucesso!`);
                ArrayDiasOff.push(date) ;
                var ul = document.getElementById("lista");
                var li = document.createElement("li");
                li.appendChild(document.createTextNode(date));
                ul.appendChild(li);
                if (Number(ArrayDiasOff.length) == '') {
                    total_dias_off = 0
                    tdiasoff.innerHTML = total_dias_off;
                } else {
                    total_dias_off = Number(ArrayDiasOff.length)
                    tdiasoff.innerHTML = total_dias_off;
                }
            }
        },
    });

});
function calcularOS() {
    n_os = $('#txt_n_os').val();
    n_ciclo = $('#txt_n_ciclo').val();
    inicio = $('#txt_inicio').val();
    fim = $('#txt_fim').val();
    qtde_dias_off = $('#tdiasoff').val();
    turnas = $('#txt_t_urnas').val();
    tbaterias = $('#txt_t_baterias').val();
    fp_diario = $('#fp_diario').val();
    local = $('#n_local').val()
      
    // var total_dias_off = 0
    var ntbat = Number(tbaterias)
    var nturnas = Number(turnas)
    var fp_diario = Number(fp_diario)
    // var qtde_dias_off = Number(qtde_dias_off)
    
    // if (n_os == '' || inicio == '' || fim == '' || turnas == ''|| tbaterias == ''){
    //     alert("Preencha todos os campos.");
    //     // var myModal = new bootstrap.Modal(document.getElementById('msgcamposVaziosModal') , true )  
    //     // myModal.show()
    //     // return false;
        
    // }
    //  } else {

        //Quantidade de dias uteis do período:
        qtde_dias = workingDaysBetweenDates(inicio, fim) 
        qtde_dias_periodo.innerHTML = `${qtde_dias}`
        //total_urnas.innerHTML = `${total_urnas}`
        //Quantidade de dias disponíveis apos dias-off: 
        //alert(` Total de Dias ${qtde_dias} Total de Dias Off: ${total_dias_off} Total de Dias disp ${qddisp}`);

        var total_dias_off = tdiasoff.innerHTML 
        var qddisp = (qtde_dias - total_dias_off)
        qtde_dias_disp.innerHTML = `${qddisp}`
                
        //Quantidade de Grupo de Atividades (GA) estimadas: 
        var qga = (nturnas + ntbat)
        var qga_n = qga.toLocaleString('pt-BR'); 
        qtde_ga.innerHTML = `${qga_n}`
                
        //Quantidade de UST:  
        var qust =  (qga / qinfra)
        var Q_UST = qust.toFixed(1).toLocaleString('pt-BR')
        qtde_ust.innerHTML = `${Q_UST}`
        //qtde_ust.innerHTML = "oooo"
  
}

function totalUrna() {

 total_urnas = Number($('#ue2009p').val() + $('#ue2010p').val() + $('#ue2011p').val() + $('#ue2013p').val() + $('#ue2015p')+ $('#ue2020p').val() + $('#ue2022p'));
 total_urnas.innerHTML = `${total_urnas}`
 alert = `${total_urnas}`
}



function addDiasOff() {

}

function gravarOS() {
    // alert("Função CriarOS ativada");
    id_ciclo = $('#txt_id_ciclo').val();
    id_local = txt_id_local.innerHTML
    n_os = $('#txt_n_os').val();
    n_ciclo = $('#txt_n_ciclo').val();
    inicio = $('#txt_inicio').val();
    fim = $('#txt_fim').val();
    turnas = $('#txt_t_urnas').val();
    tbaterias = $('#txt_t_baterias').val();
    qtde_dias_periodo = qtde_dias_periodo.innerHTML
    qtde_dias_off = tdiasoff.innerHTML
    //qtde_dias_off2 = parseFloat(qtde_dias_off)
    qtde_dias_disp = qtde_dias_disp.innerHTML
    fp_diario = fp_diario.innerHTML
    ust = qtde_ust.innerHTML
    qtde_ga = qtde_ga.innerHTML
              
        if (n_local == '' || n_os == '' || inicio == '' || fim == '' || turnas == '' || tbaterias == ''){
            alert("Preencha todos os campos.");
            return false;
        }
        
        $.ajax({
            type: "POST",
            url: '../php/os_criar_x.php',
            cache: false,
            data:{ id_ciclo:id_ciclo,id_local:id_local,n_os:n_os,inicio:inicio,fim:fim,turnas:turnas,tbaterias:tbaterias,qtde_dias_periodo:qtde_dias_periodo,qtde_dias_off:qtde_dias_off,qtde_dias_disp:qtde_dias_disp,fp_diario:fp_diario,ust:ust,qtde_ga:qtde_ga},
            success: function(dados){
            alert(dados);
            }
        });
        window.history.back();
}
var qinfra

function update() {
    var select = document.getElementById('n_local');
    var option = select.options[select.selectedIndex];
    var qinfratext = option.text ;
       
    switch (qinfratext) {
        case "NVI JPA":
            qinfra = 128
            id_local = 1
            break;
        case "NVI CGE":
            qinfra = 128
            id_local = 2
            break;
        case "NVI PAT":
            qinfra = 64
            id_local = 3
            break;
        case "NVI PBL":
            qinfra = 32
            id_local = 4
            break;
        case "NVI CJZ":
            qinfra = 32
            id_local = 5
            break;
        case "SEVIN":
            qinfra = 1
            id_local = 6
            break;                      
     
    }

    qtde_infra.innerHTML = `${qinfra}`
    txt_id_local.innerHTML = `${id_local}`
}
    //update();

function workingDaysBetweenDates(d0, d1) {
        var startDate = parseDate(d0);
        var endDate = parseDate(d1);
        
        // populate the holidays array with all required dates without first taking care of what day of the week they happen
        var holidays = ['2018-12-09', '2018-12-10', '2018-12-24', '2018-12-31'];
        // Validate input
        if (endDate < startDate)
            return 0;
    
        var z = 0; // number of days to substract at the very end
        for (i = 0; i < holidays.length; i++)
        {
            var cand = parseDate(holidays[i]);
            var candDay = cand.getDay();
    
          if (cand >= startDate && cand <= endDate && candDay != 0 && candDay != 6)
          {
            // we'll only substract the date if it is between the start or end dates AND it isn't already a saturday or sunday
            z++;
          }
    
        }
        // Calculate days between dates
        var millisecondsPerDay = 86400 * 1000; // Day in milliseconds
        startDate.setHours(0,0,0,1);  // Start just after midnight
        endDate.setHours(23,59,59,999);  // End just before midnight
        var diff = endDate - startDate;  // Milliseconds between datetime objects    
        var days = Math.ceil(diff / millisecondsPerDay);
    
        // Subtract two weekend days for every week in between
        var weeks = Math.floor(days / 7);
        days = days - (weeks * 2);
    
        // Handle special cases
        var startDay = startDate.getDay();
        var endDay = endDate.getDay();
    
        // Remove weekend not previously removed.   
        if (startDay - endDay > 1)         
            days = days - 2;      
    
        // Remove start day if span starts on Sunday but ends before Saturday
        if (startDay == 0 && endDay != 6)
            days = days - 1  
    
        // Remove end day if span ends on Saturday but starts after Sunday
        if (endDay == 6 && startDay != 0)
            days = days - 1  
    
        // substract the holiday dates from the original calculation and return to the DOM
        return days - z;
}
    
function parseDate(input) {
        // Transform date from text to date
      var parts = input.match(/(\d+)/g);
      // new Date(year, month [, date [, hours[, minutes[, seconds[, ms]]]]])
      //return new Date(parts[0], parts[1]-1, parts[2]); // months are 0-based
      return new Date(parts[2], parts[1]-1, parts[0]); // months are 0-based alterado para formato BR
}



      







