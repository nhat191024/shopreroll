export function convertToCSV(data) {
    const headers = Object.keys(data[0]);
    const rows = data.map(obj => headers.map(header => obj[header]));
    const headerRow = headers.join(',');
    const csvRow =  [headerRow, ...rows.map(row => row.join(','))].join('\n');
    return csvRow;
}

export function downloadCSV(data, filename) {
    const csv = convertToCSV(data);
    const bom = '\uFEFF'; // Byte Order Mark for UTF-8
    const csvWithBom = bom + csv;
    const blob = new Blob([csvWithBom], { type: 'text/csv;charset=utf-8;' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.setAttribute('download', filename);
    a.click();
}

export function copyToClipboard(text) {
    const el = document.createElement('textarea');
    el.value = text;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
}

export function printTable(data) {
    let table = '<table border="1"><thead><tr>';

    const keys = Object.keys(data[0]);
    keys.forEach(key => {
        table += `<th>${key}</th>`;
    });
    table += '</tr></thead><tbody>';

    data.forEach(row => {
        table += '<tr>';
        keys.forEach(key => {
            table += `<td>${row[key]}</td>`;
        });
        table += '</tr>';
    });
    table += '</tbody></table>';

    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Table</title>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(table);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}