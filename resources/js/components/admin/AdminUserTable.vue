<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="mb-4 flex justify-end space-x-2">
<!--            <button class="btn btn-export">Export CSV</button>-->
            <button @click="exportToExcel" class="btn btn-export">Export Excel</button>
            <button @click="exportToPdf" class="btn btn-export">Export PDF</button>
            <button @click="printToPdf" class="btn btn-export">Print Pdf</button>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" ref="content">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    E-mail
                </th>
                <th scope="col" class="px-6 py-3">
                    Country
                </th>
                <th scope="col" class="px-6 py-3">
                    Gender
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, index) in userData" :key="index" :class="{ 'odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700': index % 2 === 0 }">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ user.name }}
                </th>
                <td class="px-6 py-4">
                    {{ user.email }}
                </td>
                <td class="px-6 py-4">
                    {{ user.country }}
                </td>
                <td class="px-6 py-4">
                    {{ user.gender }}
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import jsPDF from 'jspdf';
import "jspdf-autotable";
import html2pdf from 'html2pdf.js';
import html2canvas from 'html2canvas';
import xlsx from 'xlsx/dist/xlsx.full.min.js';
export default {
    data(){
        return{
            userData :[
                {'name':'Code Craft. Byte Genius', 'email': 'user1@mail.com', 'country':'Bangladesh', 'gender':'Male'},
                {'name':'Tech Whiz. Code Master', 'email': 'user2@mail.com', 'country':'India', 'gender':'Female'},
                {'name':'Pixel Pro. Byte Wizard', 'email': 'user3@mail.com', 'country':'Pakistan', 'gender':'Male'},
                {'name':'Innovate Tech. Digital Genius', 'email': 'user4@mail.com', 'country':'Nepal', 'gender':'Female'},
                {'name':'Code Guru. Tech Savvy', 'email': 'user5@mail.com', 'country':'Sri lanka', 'gender':'Male'},
                {'name':'Byte Solutions. Infinite Code', 'email': 'user6@mail.com', 'country':'Pakistan', 'gender':'Female'},
                {'name':'TPixel Logic. Tech Virtuoso', 'email': 'user7@mail.com', 'country':'Iran', 'gender':'Female'},
                {'name':'Tech Whiz. Code Master', 'email': 'user8@mail.com', 'country':'China', 'gender':'Male'},
                {'name':'Code Craft. Byte Genius', 'email': 'user9@mail.com', 'country':'India', 'gender':'Male'}
            ],
            paginateData:[]
        }
    },
    methods: {
        exportToPdf() {
            // const element = this.$refs.content;
            // html2pdf(element, {
            //     margin: 0,
            //     filename: "i-was-html.pdf",
            // });

            const headers = Object.keys(this.userData[0]);
            const rows = this.userData.map(row => Object.values(row));

            const doc = new jsPDF();

            doc.autoTable({
                head: [headers],
                body: rows,
                theme: 'striped', // You can choose different themes: 'striped', 'grid', 'plain'
                startY: 20, // Starting Y position for the table
                //headStyles: { fillColor: [0, 0, 0] }, // Customize header style
                //bodyStyles: { fillColor: [245, 245, 245] }, // Customize body style
                margin: { top: 20 }
            });

            doc.save("export.pdf");
        },
        printToPdf(){
            const element = this.$refs.content;
            html2pdf().from(element).toPdf().get('pdf').then(function(pdf) {
                pdf.autoPrint();
                pdf.output('dataurlnewwindow');
            });
            // const pdfPromise = html2pdf().from(element).toPdf().get('pdf');
            // pdfPromise.then(function(pdf) {
            //     pdf.autoPrint();
            //     const newWindow = window.open('', '_blank');
            //     pdf.output('dataurlnewwindow', newWindow);
            // });
            // const doc = new jsPDF();
            // const element = this.$refs.content;
            // html2canvas(element).then(canvas => {
            //     const imgData = canvas.toDataURL('image/png');
            //     doc.addImage(imgData, 'PNG', 0, 0);
            //     doc.addPage();
            //     doc.autoTable({ html: element });
            //     doc.save('filename.pdf');
            // });
        },
        exportToExcel(){
            const headers = Object.keys(this.userData[0]);
            const rows = this.userData.map(row => Object.values(row));

            // Combine headers and rows
            const data = [headers, ...rows];

            // Create a new workbook
            const wb = XLSX.utils.book_new();

            // Add a worksheet to the workbook
            const ws = XLSX.utils.aoa_to_sheet(data);

            // Save the workbook as an Excel file
            XLSX.writeFile(wb, 'filename.xlsx');
        }
    }
}
</script>
<style scoped>
.btn-export {
    @apply bg-blue-500 text-white font-semibold py-2 px-4 rounded shadow hover:bg-blue-700;
}
</style>
