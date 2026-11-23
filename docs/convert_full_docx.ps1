param()

$baseDir = "C:\Users\PN\Documents\BBU SR\THE SIS_BBU University\Banking_sys"
$docsDir = "$baseDir\docs"
$diagramsDir = "$docsDir\diagrams"
$htmlPath = "$docsDir\dfd_source.html"
$docxPath1 = "$docsDir\DFD_Full_Specification_BBU_Banking_System.docx"
$docxPath2 = "$baseDir\DFD_Full_Specification_BBU_Banking_System.docx"

$img1 = "$diagramsDir\dfd_level_0_context_diagram.png"
$img2 = "$diagramsDir\dfd_level_1_system.png"
$img3 = "$diagramsDir\dfd_level_2_loan_process.png"

$img1Uri = [System.Uri]::new($img1).AbsoluteUri
$img2Uri = [System.Uri]::new($img2).AbsoluteUri
$img3Uri = [System.Uri]::new($img3).AbsoluteUri

$htmlContent = @"
<!DOCTYPE html>
<html lang="km">
<head>
<meta charset="utf-8">
<title>DFD Full Specification - BBU Banking System</title>
<style>
@page {
    size: A4 portrait;
    margin: 2.54cm 2.54cm 2.54cm 2.54cm;
}
body {
    font-family: 'Khmer OS Battambang', 'Khmer OS', 'Calibri', Arial, sans-serif;
    font-size: 11pt;
    line-height: 1.6;
    color: #2b2b2b;
}
.header-box {
    text-align: center;
    margin-bottom: 25px;
    padding: 20px;
    background-color: #f4f6f7;
    border: 1px solid #d5dbdb;
}
.univ-title {
    font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', Arial, sans-serif;
    font-size: 15pt;
    color: #003366;
    margin: 0 0 4px 0;
}
.faculty-title {
    font-size: 11.5pt;
    font-weight: bold;
    color: #566573;
    margin: 0 0 15px 0;
}
.doc-title-km {
    font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', Arial, sans-serif;
    font-size: 18pt;
    color: #1b4f72;
    margin: 0 0 6px 0;
}
.doc-title-en {
    font-family: Arial, sans-serif;
    font-size: 13pt;
    font-weight: bold;
    color: #2874a6;
    margin: 0 0 10px 0;
}
.sys-title {
    font-size: 12pt;
    font-style: italic;
    color: #2c3e50;
    margin: 0;
}
h1 {
    font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', Arial, sans-serif;
    color: #003366;
    font-size: 14pt;
    margin-top: 25px;
    margin-bottom: 10px;
    border-bottom: 2px solid #003366;
    padding-bottom: 4px;
}
h2 {
    font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', Arial, sans-serif;
    color: #1a5276;
    font-size: 12.5pt;
    margin-top: 18px;
    margin-bottom: 8px;
}
h3 {
    font-size: 11.5pt;
    font-weight: bold;
    color: #2874a6;
    margin-top: 14px;
    margin-bottom: 6px;
}
p {
    margin: 6px 0;
    text-align: justify;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin: 14px 0;
    font-size: 10pt;
}
th {
    background-color: #003366;
    color: #ffffff;
    font-family: 'Khmer OS Muol Light', Arial, sans-serif;
    font-weight: normal;
    padding: 8px 10px;
    text-align: left;
    border: 1px solid #003366;
}
td {
    padding: 8px 10px;
    border: 1px solid #bdc3c7;
    vertical-align: top;
}
tr:nth-child(even) {
    background-color: #f8f9fa;
}
.ascii-box {
    background-color: #f2f4f4;
    border-left: 4px solid #003366;
    padding: 12px;
    font-family: Consolas, 'Courier New', monospace;
    font-size: 9pt;
    line-height: 1.35;
    white-space: pre;
    overflow-x: auto;
    margin: 12px 0;
}
.img-wrap {
    text-align: center;
    margin: 18px 0;
}
.img-wrap img {
    max-width: 95%;
    height: auto;
    border: 1px solid #bdc3c7;
}
.img-caption {
    font-size: 9.5pt;
    font-style: italic;
    font-weight: bold;
    color: #566573;
    margin-top: 6px;
}
ul {
    margin: 6px 0;
    padding-left: 22px;
}
li {
    margin-bottom: 6px;
}
</style>
</head>
<body>

<div class="header-box">
    <div class="univ-title">សាកលវិទ្យាល័យ បៀលប្រាយ (BUILD BRIGHT UNIVERSITY)</div>
    <div class="faculty-title">មហាវិទ្យាល័យវិទ្យាសាស្ត្រ និងបច្ចេកវិទ្យា (FACULTY OF SCIENCE & TECHNOLOGY)</div>
    <div class="doc-title-km">ឯកសារលម្អិតស្តីពី គំនូសតាងលំហូរទិន្នន័យ</div>
    <div class="doc-title-en">DATA FLOW DIAGRAM (DFD) FULL SPECIFICATION</div>
    <div class="sys-title">ប្រព័ន្ធគ្រប់គ្រងធនាគារ និងឥណទាន (Banking & Loan Management System)</div>
</div>

<h1>១. និយមន័យ និងនិមិត្តសញ្ញាគំនូសតាង (DFD Conventions)</h1>
<p>គំនូសតាងលំហូរទិន្នន័យ (Data Flow Diagram - DFD) ត្រូវបានរៀបចំឡើងតាមស្តង់ដារ Yourdon & Coad / Gane & Sarson ដើម្បីបង្ហាញពីដំណើរការបំលែងទិន្នន័យ ចរន្តលំហូរព័ត៌មាន និងឃ្លាំងផ្ទុកទិន្នន័យនៃប្រព័ន្ធធនាគារ និងឥណទាន៖</p>

<table>
<tr>
    <th style="width:16%;">និមិត្តសញ្ញា</th>
    <th style="width:30%;">ឈ្មោះបច្ចេកទេស</th>
    <th style="width:54%;">ការបរិយាយមុខងារ</th>
</tr>
<tr>
    <td><b>[ ឈ្មោះ ]</b></td>
    <td><b>អង្គភាពខាងក្រៅ (External Entity)</b></td>
    <td>តំណាងឱ្យបុគ្គល ឬប្រព័ន្ធខាងក្រៅដែលមានអន្តរកម្មបញ្ជូន/ទទួលទិន្នន័យពីប្រព័ន្ធ (អតិថិជន, បុគ្គលិក, អ្នកគ្រប់គ្រង)</td>
</tr>
<tr>
    <td><b>( លេខ.ឈ្មោះ )</b></td>
    <td><b>ដំណើរការបំលែង (Process)</b></td>
    <td>តំណាងឱ្យសកម្មភាព ឬអនុគមន៍ដែលទទួលទិន្នន័យចូលមកកែច្នៃ គណនា និងបញ្ចេញផល (ឧទាហរណ៍៖ 1.0, 2.0...)</td>
</tr>
<tr>
    <td><b>| D# | ឈ្មោះ</b></td>
    <td><b>ឃ្លាំងផ្ទុកទិន្នន័យ (Data Store)</b></td>
    <td>តំណាងឱ្យតារាងក្នុងមូលដ្ឋានទិន្នន័យ (Database Tables) សម្រាប់រក្សាទុកព័ត៌មានជាអចិន្ត្រៃយ៍</td>
</tr>
<tr>
    <td><b>--------&gt;</b></td>
    <td><b>លំហូរទិន្នន័យ (Data Flow)</b></td>
    <td>តំណាងឱ្យទិសដៅនៃទិន្នន័យ ឬឯកសារដែលធ្វើដំណើរឆ្លងកាត់ពីចំណុចមួយទៅចំណុចមួយទៀត</td>
</tr>
</table>

<h1>២. DFD កម្រិត ០ ៖ គំនូសតាងបរិបទប្រព័ន្ធ (Context Diagram - Level 0)</h1>
<p>គំនូសតាងបរិបទកម្រិត ០ បង្ហាញពីព្រំដែនប្រព័ន្ធទាំងមូល (System Boundary) ដោយចាត់ទុកប្រព័ន្ធទាំងមូលជាដំណើរការមេតែមួយ (0.0 Banking & Loan Management System) និងបង្ហាញពីការផ្លាស់ប្តូរទិន្នន័យជាមួយអង្គភាពខាងក្រៅសំខាន់ៗចំនួន ៣៖</p>

<div class="img-wrap">
    <img src="$img1Uri" alt="DFD Level 0 Context Diagram">
    <div class="img-caption">រូបភាពទី ១ ៖ គំនូសតាងបរិបទប្រព័ន្ធកម្រិត ០ (DFD Level 0 Context Diagram)</div>
</div>

<div class="ascii-box">                 +---------------------------+
                 |    អតិថិជន / អ្នកខ្ចីប្រាក់   |
                 |     (Customer / Borrower) |
                 +---------------------------+
                   |                       ^
  [ពាក្យស្នើសុំកម្ចី, KYC/ID,                | [ស្ថានភាពកម្ចី, តារាងបង់ប្រាក់,
   ប្រាក់សងត្រឡប់, ប្រាក់បញ្ញើ]                 |  បង្កាន់ដៃទទួលប្រាក់, របាយការណ៍]
                   |                       |
                   v                       |
+------------------------------------------------------------------+
|                                                                  |
|              0.0 ប្រព័ន្ធគ្រប់គ្រងធនាគារ និងឥណទាន                  |
|              (BANKING & LOAN MANAGEMENT SYSTEM)                  |
|                                                                  |
+------------------------------------------------------------------+
       ^            |                                 ^         |
       |            |                                 |         |
[គណនីបុគ្គលិក,      | [ទិន្នន័យអតិថិជន,              [គណនី Admin,     | [របាយការណ៍សវនកម្ម,
 វាយតម្លៃកម្ចី,      |  ស្ថានភាពឯកសារ,                 គោលការណ៍ប្រព័ន្ធ, |  របាយការណ៍ចំណូល,
 កត់ត្រាការសងប្រាក់] |  ការអនុម័តកម្ចី]                 កំណត់សិទ្ធិ Role] |  របាយការណ៍ឥណទាន]
       |            v                                 |         v
+---------------------------+             +---------------------------+
|    មន្ត្រីឥណទាន / បុគ្គលិក   |             |      ប្រធានសាខា / Admin   |
|   (Loan Officer / Staff)  |             |      (Manager / Admin)    |
+---------------------------+             +---------------------------+</div>

<h3>ការបរិយាយអំពីអង្គភាពខាងក្រៅ (External Entities):</h3>
<ul>
    <li><b>អតិថិជន / អ្នកខ្ចីប្រាក់ (Customer / Borrower)៖</b> បញ្ចូលឯកសារផ្ទាល់ខ្លួន (KYC), ស្នើសុំកម្ចី, ដាក់ឯកសារទ្រព្យបញ្ចាំ, និងបង់ប្រាក់សងត្រឡប់ ឬផ្ញើប្រាក់បញ្ញើ។ ទទួលបានមកវិញនូវតារាងកាលវិភាគបង់ប្រាក់, វិក្កយបត្រទទួលប្រាក់ និងដំណឹងអនុម័តកម្ចី។</li>
    <li><b>មន្ត្រីឥណទាន / បុគ្គលិក (Loan Officer / Staff)៖</b> ផ្ទៀងផ្ទាត់អត្តសញ្ញាណអតិថិជន, បញ្ចូលទិន្នន័យទ្រព្យបញ្ចាំ, រៀបចំសំណើកម្ចី, និងកត់ត្រាការបង់ប្រាក់ប្រចាំខែ។</li>
    <li><b>ប្រធានសាខា / អ្នកគ្រប់គ្រងប្រព័ន្ធ (Branch Manager / Admin)៖</b> ពិនិត្យវាយតម្លៃ និងអនុម័តកម្ចី, កំណត់តួនាទី និងសិទ្ធិបុគ្គលិក (RBAC), ពិនិត្យរបាយការណ៍ចំណូល និងតាមដានកំណត់ត្រាសវនកម្មប្រព័ន្ធ (Audit Logs)។</li>
</ul>

<h1>៣. DFD កម្រិត ១ ៖ គំនូសតាងប្រព័ន្ធកម្រិតខ្ពស់ (System Level 1 Diagram)</h1>
<p>DFD កម្រិត ១ បំបែកប្រព័ន្ធមេជា ៦ ដំណើរការស្នូល និង ៦ ឃ្លាំងផ្ទុកទិន្នន័យ (Data Stores) ស្របតាមរចនាសម្ព័ន្ធពិតប្រាកដនៃកម្មវិធី៖</p>

<div class="img-wrap">
    <img src="$img2Uri" alt="DFD Level 1 System Diagram">
    <div class="img-caption">រូបភាពទី ២ ៖ គំនូសតាងលំហូរទិន្នន័យប្រព័ន្ធកម្រិត ១ (DFD Level 1 System Diagram)</div>
</div>

<table>
<tr>
    <th style="width:12%;">លេខដំណើរការ</th>
    <th style="width:33%;">ឈ្មោះដំណើរការ (Process Name)</th>
    <th style="width:55%;">ភារកិច្ច និងប្រតិបត្តិការ</th>
</tr>
<tr><td><b>1.0</b></td><td><b>ការផ្ទៀងផ្ទាត់ និងគ្រប់គ្រងសិទ្ធិ</b></td><td>ផ្ទៀងផ្ទាត់គណនីបុគ្គលិក និងអ្នកគ្រប់គ្រង ដោយផ្អែកលើតួនាទី និងសិទ្ធិ (Permissions: manage-loans, view-borrowers, view-reports)</td></tr>
<tr><td><b>2.0</b></td><td><b>ការគ្រប់គ្រងព័ត៌មានអតិថិជន</b></td><td>ចុះឈ្មោះ និងកែប្រែព័ត៌មានអតិថិជន (ឈ្មោះខ្មែរ/ឡាតាំង, អត្តសញ្ញាណប័ណ្ណ, ភេទ, ថ្ងៃខែឆ្នាំកំណើត, មុខរបរ, អាសយដ្ឋាន, លេខទូរស័ព្ទ)</td></tr>
<tr><td><b>3.0</b></td><td><b>ការគ្រប់គ្រងទ្រព្យបញ្ចាំ</b></td><td>កត់ត្រាព័ត៌មានទ្រព្យធានាកម្ចី (ប្លង់ដី, កាតគ្រីយានយន្ត, អចលនទ្រព្យ), លេខប័ណ្ណកម្មសិទ្ធិ និងតម្លៃវាយតម្លៃទីផ្សារជាក់ស្តែង</td></tr>
<tr><td><b>4.0</b></td><td><b>ដំណើរការស្នើសុំ និងអនុម័តកម្ចី</b></td><td>គណនាអត្រាការប្រាក់, រយៈពេល, រូបិយប័ណ្ណ (KHR/USD), បង្កើតកាលវិភាគបង់ប្រាក់ និងដំណើរការអនុម័តដោយប្រធានសាខា</td></tr>
<tr><td><b>5.0</b></td><td><b>ដំណើរការសងប្រាក់ និងប្រាក់បញ្ញើ</b></td><td>ទទួលប្រាក់សងប្រចាំខែ, គណនាបំបែកប្រាក់ដើមនិងការប្រាក់, កាត់កងសមតុល្យបំណុលនៅសល់, និងគ្រប់គ្រងប្រាក់បញ្ញើសន្សំ</td></tr>
<tr><td><b>6.0</b></td><td><b>ការចេញរបាយការណ៍ និងសវនកម្ម</b></td><td>ទាញទិន្នន័យដើម្បីចេញជារបាយការណ៍ផលប័ត្រឥណទាន, បញ្ជីបំណុលយឺតយ៉ាវ, របាយការណ៍ចំណូល និងកត់ត្រារាល់សកម្មភាពរបស់អ្នកប្រើប្រាស់ក្នុងប្រព័ន្ធ</td></tr>
</table>

<h1>៤. DFD កម្រិត ២ ៖ ដំណើរការរងលម្អិត (Detailed Level 2 Processes)</h1>
<h2>៤.១ ដំណើរការ ៤.០ ៖ ដំណើរការស្នើសុំ និងអនុម័តកម្ចី (Loan Management Sub-processes)</h2>
<p>ដំណើរការ ៤.០ ត្រូវបានបំបែកជា ៤ ដំណើរការរង ដើម្បីគ្រប់គ្រងវដ្តជីវិតនៃកម្ចីទាំងមូល៖</p>

<div class="img-wrap">
    <img src="$img3Uri" alt="DFD Level 2 Loan Process">
    <div class="img-caption">រូបភាពទី ៣ ៖ គំនូសតាងលំហូរទិន្នន័យកម្រិត ២ នៃដំណើរការកម្ចី (DFD Level 2 Loan Process)</div>
</div>

<div class="ascii-box">[ អតិថិជន / មន្ត្រីឥណទាន ]
       |
       |--- (ព័ត៌មានស្នើសុំកម្ចី)
       v
( ៤.១ ទទួលពាក្យស្នើសុំកម្ចី )
       |
       |--- [ពិនិត្យលក្ខខណ្ឌបឋម]
       v
( ៤.២ ផ្ទៀងផ្ទាត់ទ្រព្យបញ្ចាំ និងប្រវត្តិឥណទាន ) &lt;==== | D2: អតិថិជន |
       |                                         &lt;==== | D3: ទ្រព្យបញ្ចាំ |
       |--- [លទ្ធផលវាយតម្លៃហានិភ័យ]
       v
( ៤.៣ វាយតម្លៃ និងសម្រេចអនុម័តកម្ចី ) &lt;============== [ ប្រធានសាខា / Admin ]
       |                                                         |
       |--- [លទ្ធផល៖ យល់ព្រម ឬ បដិសេធ] &lt;-----------------------+
       v
( ៤.៤ បើកផ្តល់ប្រាក់កម្ចី និងចេញកាលវិភាគ )
       |
       |---&gt; [រក្សាទុកកិច្ចសន្យា &amp; តារាងបង់ប្រាក់] ========&gt; | D4: ឥណទាន/កម្ចី |
       |
       +---&gt; [ប្រគល់សាច់ប្រាក់ និងតារាងកាលវិភាគ] ========&gt; [ អតិថិជន / អ្នកខ្ចី ]</div>

<ul>
    <li><b>ដំណើរការ ៤.១ (ទទួលពាក្យស្នើសុំ)៖</b> បញ្ចូលទំហំទឹកប្រាក់ស្នើសុំ, រយៈពេល, រូបិយប័ណ្ណ (KHR/USD), និងគោលបំណងកម្ចី។</li>
    <li><b>ដំណើរការ ៤.២ (ផ្ទៀងផ្ទាត់ទ្រព្យបញ្ចាំ និងប្រវត្តិ)៖</b> ផ្ទៀងផ្ទាត់ប្រវត្តិអតិថិជនពី D2 និងពិនិត្យតម្លៃទីផ្សារនៃទ្រព្យបញ្ចាំពី D3 ដើម្បីធានាសមាមាត្រទំហំកម្ចីធៀបនឹងទ្រព្យ (LTV Ratio)។</li>
    <li><b>ដំណើរការ ៤.៣ (វាយតម្លៃ និងសម្រេចអនុម័តកម្ចី)៖</b> ប្រធានសាខាពិនិត្យ និងចុចអនុម័ត (Approve) ឬច្រានចោល (Reject)។</li>
    <li><b>ដំណើរការ ៤.៤ (បើកផ្តល់ប្រាក់កម្ចី និងចេញកាលវិភាគ)៖</b> ប្រព័ន្ធគណនាតារាងបង់ប្រាក់ប្រចាំខែ (Schedule), កត់ត្រាចូល D4, និងបោះពុម្ពតារាងជូនអតិថិជន។</li>
</ul>

<h2>៤.២ ដំណើរការ ៥.០ ៖ ដំណើរការសងប្រាក់ និងប្រាក់បញ្ញើ (Repayment Sub-processes)</h2>
<p>ដំណើរការ ៥.០ ទទួលខុសត្រូវលើការកាត់កងបំណុល និងការចេញបង្កាន់ដៃទូទាត់ប្រាក់៖</p>

<div class="ascii-box">[ អតិថិជន / អ្នកខ្ចី ]
       |
       |--- (សាច់ប្រាក់សងប្រចាំខែ)
       v
( ៥.១ ស្វែងរកកាលវិភាគបង់ប្រាក់ដែលដល់កំណត់ ) &lt;==== | D4: ឥណទាន/កម្ចី |
       |
       |--- [ទិន្នន័យចំនួនទឹកប្រាក់ត្រូវបង់]
       v
( ៥.២ គណនាបំបែកប្រាក់ដើម និងការប្រាក់ )
       |
       |--- [ទិន្នន័យបំបែកការទូទាត់]
       v
( ៥.៣ កត់ត្រាការទូទាត់ និងកាត់កងសមតុល្យ )
       |
       |---&gt; [កែប្រែសមតុល្យបំណុលនៅសល់] ============== Cab &gt; | D4: ឥណទាន/កម្ចី |
       |---&gt; [រក្សាទុកកំណត់ត្រាប្រតិបត្តិការបង់ប្រាក់] ==&gt; | D5: ការសងប្រាក់ |
       |
       +---&gt; [ចេញបង្កាន់ដៃទទួលប្រាក់ជាផ្លូវការ] ========&gt; [ អតិថិជន / អ្នកខ្ចី ]</div>

<h1>៥. វចនានុក្រមទិន្នន័យ (Data Dictionary)</h1>
<h2>៥.១ និយមន័យឃ្លាំងផ្ទុកទិន្នន័យ (Data Stores Definition)</h2>
<table>
<tr>
    <th style="width:10%;">លេខកូដ</th>
    <th style="width:25%;">ឈ្មោះឃ្លាំងទិន្នន័យ</th>
    <th style="width:25%;">តារាង Database</th>
    <th style="width:40%;">វាលទិន្នន័យសំខាន់ៗ (Attributes)</th>
</tr>
<tr><td><b>D1</b></td><td>អ្នកប្រើប្រាស់ និងសិទ្ធិ</td><td><code>users, roles, permissions</code></td><td>UserID, Name, Email, PasswordHash, RoleID, PermissionsList, Status</td></tr>
<tr><td><b>D2</b></td><td>អតិថិជន</td><td><code>customers</code></td><td>CustomerID, FullNameKhmer, FullNameLatin, Gender, DOB, Phone, NationalID, Address, JobTitle</td></tr>
<tr><td><b>D3</b></td><td>ទ្រព្យបញ្ចាំ</td><td><code>collaterals</code></td><td>CollateralID, CustomerID, AssetType, Value, DocumentNumber, Status, Description</td></tr>
<tr><td><b>D4</b></td><td>ឥណទាន / កម្ចី</td><td><code>loans</code></td><td>LoanID, CustomerID, LoanAmount, Currency (USD/KHR), InterestRate, DurationMonths, Status, DisbursedDate</td></tr>
<tr><td><b>D5</b></td><td>ការសងប្រាក់ &amp; បញ្ញើ</td><td><code>repayments, deposits</code></td><td>RepaymentID, LoanID, AmountPaid, PrincipalPortion, InterestPortion, PaymentDate, ReceiptNumber</td></tr>
<tr><td><b>D6</b></td><td>កំណត់ត្រាសវនកម្ម</td><td><code>audit_logs</code></td><td>LogID, UserID, Action, ModuleAffected, IPAddress, Timestamp, PreviousState, NewState</td></tr>
</table>

<h2>៥.២ និយមន័យលំហូរទិន្នន័យចម្បង (Main Data Flows)</h2>
<ul>
    <li><b>DF01 (ព័ត៌មានអតិថិជន KYC) =</b> ឈ្មោះខ្មែរ + ឈ្មោះឡាតាំង + លេខអត្តសញ្ញាណប័ណ្ណ + ភេទ + ថ្ងៃខែឆ្នាំកំណើត + មុខរបរ + អាសយដ្ឋាន + លេខទូរស័ព្ទ</li>
    <li><b>DF02 (ព័ត៌មានទ្រព្យបញ្ចាំ) =</b> លេខកូដអតិថិជន + ប្រភេទទ្រព្យ + លេខប័ណ្ណកម្មសិទ្ធិ/កាតគ្រី + តម្លៃប៉ាន់ស្មាន + ថ្ងៃវាយតម្លៃ</li>
    <li><b>DF03 (ព័ត៌មានស្នើសុំកម្ចី) =</b> លេខកូដអតិថិជន + ចំនួនទឹកប្រាក់កម្ចី + រូបិយប័ណ្ណ (KHR/USD) + រយៈពេលខ្ចី + គោលបំណងកម្ចី</li>
    <li><b>DF04 (ការអនុម័តកម្ចី) =</b> លេខកូដកម្ចី + អ្នកអនុម័ត (AdminID) + ស្ថានភាព (Approved/Rejected) + កាលបរិច្ឆេទអនុម័ត</li>
    <li><b>DF05 (ប្រតិបត្តិការសងប្រាក់) =</b> លេខកូដកម្ចី + ចំនួនប្រាក់បានបង់ + ប្រាក់ដើម + ការប្រាក់ + ថ្ងៃបង់ប្រាក់</li>
    <li><b>DF06 (បង្កាន់ដៃទទួលប្រាក់) =</b> លេខវិក្កយបត្រ + ឈ្មោះអតិថិជន + ចំនួនប្រាក់បានបង់ + សមតុល្យបំណុលនៅសល់ + ថ្ងៃត្រូវបង់លើកក្រោយ</li>
    <li><b>DF07 (របាយការណ៍សរុប) =</b> ទំហំកម្ចីបើកផ្តល់សរុប + ប្រាក់ប្រមូលបានសរុប + សមតុល្យឥណទានសកម្ម + បញ្ជីកម្ចីយឺតយ៉ាវ (NPL)</li>
</ul>

<h1>៦. តារាងសង្ខេប IPO (ធាតុចូល - ដំណើរការ - ធាតុចេញ)</h1>
<table>
<tr>
    <th style="width:20%;">លេខ &amp; ដំណើរការ</th>
    <th style="width:20%;">លំហូរធាតុចូល (Inputs)</th>
    <th style="width:16%;">ប្រភព (Source)</th>
    <th style="width:24%;">លំហូរធាតុចេញ (Outputs)</th>
    <th style="width:20%;">គោលដៅ (Destination)</th>
</tr>
<tr><td><b>1.0 ការផ្ទៀងផ្ទាត់សិទ្ធិ</b></td><td>អ៊ីមែល និងពាក្យសម្ងាត់</td><td>បុគ្គលិក / Admin</td><td>សិទ្ធិ និងវេន Session</td><td>D1, ចំណុចប្រទាក់ Staff</td></tr>
<tr><td><b>2.0 គ្រប់គ្រងអតិថិជន</b></td><td>ព័ត៌មានអត្តសញ្ញាណប័ណ្ណ &amp; KYC</td><td>មន្ត្រីឥណទាន</td><td>កំណត់ត្រាប្រវត្តិរូបអតិថិជន</td><td>D2 (Customers)</td></tr>
<tr><td><b>3.0 គ្រប់គ្រងទ្រព្យបញ្ចាំ</b></td><td>ព័ត៌មានទ្រព្យ &amp; តម្លៃវាយតម្លៃ</td><td>បុគ្គលិក / អតិថិជន</td><td>បញ្ជីចុះឈ្មោះទ្រព្យធានា</td><td>D3 (Collaterals)</td></tr>
<tr><td><b>4.0 គ្រប់គ្រងកម្ចី &amp; អនុម័ត</b></td><td>លក្ខខណ្ឌកម្ចី &amp; ការសម្រេច</td><td>Staff / Admin / D2, D3</td><td>កិច្ចសន្យាកម្ចី &amp; តារាងបង់ប្រាក់</td><td>D4 (Loans), អតិថិជន</td></tr>
<tr><td><b>5.0 សងប្រាក់ &amp; បញ្ញើ</b></td><td>សាច់ប្រាក់បង់សង ឬផ្ញើសន្សំ</td><td>អតិថិជន / បេឡា / D4</td><td>សមតុល្យថ្មី &amp; វិក្កយបត្របង់ប្រាក់</td><td>D4, D5, អតិថិជន</td></tr>
<tr><td><b>6.0 របាយការណ៍ &amp; សវនកម្ម</b></td><td>កំណត់ត្រាប្រតិបត្តិការ &amp; Logs</td><td>D4, D5, ប្រព័ន្ធ</td><td>របាយការណ៍ហិរញ្ញវត្ថុ &amp; សវនកម្ម</td><td>D6, ប្រធានសាខា</td></tr>
</table>

<h1>៧. វិធានអាជីវកម្ម និងសុចរិតភាពប្រព័ន្ធ (Business Rules &amp; Constraints)</h1>
<ul>
    <li><b>១. គោលការណ៍រក្សាទិន្នន័យ (Data Conservation Rule)៖</b> គ្មានដំណើរការណាបង្កើតទិន្នន័យដោយគ្មានធាតុចូលនោះឡើយ (No Miracles) ហើយក៏គ្មានដំណើរការណាទទួលទិន្នន័យចូលដោយមិនបញ្ចេញផលនោះដែរ (No Black Holes)។ ឃ្លាំងទិន្នន័យ (Data Store) មិនអាចផ្ទេរទិន្នន័យទៅកាន់ឃ្លាំងទិន្នន័យមួយទៀតដោយផ្ទាល់បានទេ ពោលគឺត្រូវឆ្លងកាត់ដំណើរការ (Process) ជានិច្ច។</li>
    <li><b>២. ការគ្រប់គ្រងរូបិយប័ណ្ណពីរ (USD និង KHR)៖</b> រាល់ដំណើរការគណនាកម្ចី (ដំណើរការ ៤.០) និងការសងប្រាក់ (ដំណើរការ ៥.០) ត្រូវតែបែងចែកដាច់ដោយឡែករវាងប្រាក់ដុល្លារ ($) និងប្រាក់រៀល (៛) ដោយមិនច្របល់គណនីគ្នាឡើយ។</li>
    <li><b>៣. លក្ខខណ្ឌទ្រព្យបញ្ចាំធានាកម្ចី (Collateral Coverage Rule)៖</b> មុនពេលដំណើរការ ៤.៣ អនុម័តកម្ចី តម្លៃប៉ាន់ស្មាននៃទ្រព្យបញ្ចាំក្នុង D3: Collaterals ត្រូវតែធានាបាននូវអត្រាសុវត្ថិភាពខ្ពស់ជាង ឬស្មើនឹងទំហំទឹកប្រាក់កម្ចីដែលបានស្នើសុំស្របតាមគោលការណ៍ឥណទានធនាគារ។</li>
    <li><b>៤. កំណត់ត្រាសវនកម្មស្វ័យប្រវត្តិ (Automatic Audit Logging)៖</b> រាល់ការបង្កើត, កែប្រែ ឬលុបទិន្នន័យក្នុងដំណើរការ ២.០, ៤.០ និង ៥.០ នឹងបញ្ជូនលំហូរទិន្នន័យដោយស្វ័យប្រវត្តិទៅកាន់ D6: Audit Logs ដើម្បីកត់ត្រា អត្តសញ្ញាណអ្នកធ្វើ (User_ID), ប្រភេទសកម្មភាព (Action) និង ពេលវេលាជាក់ស្តែង (Timestamp)។</li>
</ul>

</body>
</html>
"@

[System.IO.File]::WriteAllText($htmlPath, $htmlContent, [System.Text.Encoding]::UTF8)
Write-Host "Source HTML saved: $htmlPath"

# Now open Microsoft Word to convert into native 100% compliant DOCX
$word = New-Object -ComObject Word.Application
$word.Visible = $false
$word.DisplayAlerts = [Microsoft.Office.Interop.Word.WdAlertLevel]::wdAlertsNone

try {
    $doc = $word.Documents.Open($htmlPath)

    # Embed all linked images so the docx is fully standalone
    foreach ($shape in $doc.InlineShapes) {
        try {
            if ($shape.LinkFormat) {
                $shape.LinkFormat.SavePictureWithDocument = $true
                $shape.LinkFormat.BreakLink()
            }
        } catch {}
    }

    # Save to docs folder
    $doc.SaveAs2($docxPath1, 16)
    Write-Host "Saved DOCX: $docxPath1 ($((Get-Item $docxPath1).Length) bytes)"

    # Save to root folder
    $doc.SaveAs2($docxPath2, 16)
    Write-Host "Saved DOCX: $docxPath2 ($((Get-Item $docxPath2).Length) bytes)"

    $doc.Close()
} finally {
    $word.Quit()
    [System.Runtime.Interopservices.Marshal]::ReleaseComObject($word) | Out-Null
    [System.GC]::Collect()
    [System.GC]::WaitForPendingFinalizers()
}

# Verification step: Re-open the generated DOCX with Word COM to prove it opens without error!
$word2 = New-Object -ComObject Word.Application
$word2.Visible = $false
try {
    $testDoc = $word2.Documents.Open($docxPath2)
    Write-Host "VERIFICATION SUCCESS: Word opened DOCX successfully! Paragraph count: $($testDoc.Paragraphs.Count)"
    $testDoc.Close()
} catch {
    Write-Host "VERIFICATION ERROR: $_"
} finally {
    $word2.Quit()
    [System.Runtime.Interopservices.Marshal]::ReleaseComObject($word2) | Out-Null
}

