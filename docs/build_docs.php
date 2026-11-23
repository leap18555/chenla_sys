<?php

$baseDir = dirname(__DIR__);
$docsDir = $baseDir . '/docs';
$diagramsDir = $docsDir . '/diagrams';

$img1Path = $diagramsDir . '/dfd_level_0_context_diagram.png';
$img2Path = $diagramsDir . '/dfd_level_1_system.png';
$img3Path = $diagramsDir . '/dfd_level_2_loan_process.png';

$hasImg1 = file_exists($img1Path);
$hasImg2 = file_exists($img2Path);
$hasImg3 = file_exists($img3Path);

function xmlSafe($text) {
    return htmlspecialchars($text, ENT_XML1, 'UTF-8');
}

function p($text, $opts = []) {
    $align = $opts['align'] ?? 'left';
    $bold = $opts['bold'] ?? false;
    $italic = $opts['italic'] ?? false;
    $size = $opts['size'] ?? 22;
    $color = $opts['color'] ?? '2B2B2B';
    $spaceBefore = $opts['before'] ?? 100;
    $spaceAfter = $opts['after'] ?? 100;
    $font = $opts['font'] ?? 'Khmer OS Battambang';
    $asciiFont = $opts['asciiFont'] ?? 'Calibri';
    $bullet = $opts['bullet'] ?? false;
    $code = $opts['code'] ?? false;
    $bgColor = $opts['bg'] ?? null;

    $jcXml = ($align !== 'left') ? "<w:jc w:val=\"{$align}\"/>" : '';
    $shdXml = $bgColor ? "<w:shd w:val=\"clear\" w:color=\"auto\" w:fill=\"{$bgColor}\"/>" : '';

    $rPr = "<w:rPr>";
    $rPr .= "<w:rFonts w:ascii=\"{$asciiFont}\" w:hAnsi=\"{$asciiFont}\" w:cs=\"{$font}\"/>";
    if ($bold) $rPr .= "<w:b/><w:bCs/>";
    if ($italic) $rPr .= "<w:i/><w:iCs/>";
    if ($color) $rPr .= "<w:color w:val=\"{$color}\"/>";
    $rPr .= "<w:sz w:val=\"{$size}\"/><w:szCs w:val=\"{$size}\"/>";
    $rPr .= "</w:rPr>";

    $prefix = $bullet ? "• " : "";

    $xml = "<w:p>";
    $xml .= "<w:pPr>";
    $xml .= $jcXml;
    $xml .= "<w:spacing w:before=\"{$spaceBefore}\" w:after=\"{$spaceAfter}\" w:line=\"280\" w:lineRule=\"auto\"/>";
    if ($shdXml) $xml .= $shdXml;
    if ($bullet) {
        $xml .= "<w:ind w:left=\"360\" w:hanging=\"360\"/>";
    }
    $xml .= "</w:pPr>";

    if ($code) {
        $lines = explode("\n", $text);
        foreach ($lines as $i => $line) {
            $xml .= "<w:r>{$rPr}<w:t xml:space=\"preserve\">" . xmlSafe($line) . "</w:t></w:r>";
            if ($i < count($lines) - 1) {
                $xml .= "<w:r><w:br/></w:r>";
            }
        }
    } else {
        $xml .= "<w:r>{$rPr}<w:t xml:space=\"preserve\">" . xmlSafe($prefix . $text) . "</w:t></w:r>";
    }
    $xml .= "</w:p>";
    return $xml;
}

function heading($text, $level = 1) {
    if ($level === 1) {
        return p($text, [
            'size' => 32,
            'bold' => true,
            'color' => '003366',
            'before' => 300,
            'after' => 120,
            'font' => 'Khmer OS Muol Light',
            'asciiFont' => 'Arial'
        ]);
    } elseif ($level === 2) {
        return p($text, [
            'size' => 26,
            'bold' => true,
            'color' => '1A5276',
            'before' => 220,
            'after' => 80,
            'font' => 'Khmer OS Muol Light',
            'asciiFont' => 'Arial'
        ]);
    } else {
        return p($text, [
            'size' => 24,
            'bold' => true,
            'color' => '2874A6',
            'before' => 160,
            'after' => 60,
            'font' => 'Khmer OS Battambang',
            'asciiFont' => 'Calibri'
        ]);
    }
}

function codeBox($text) {
    return p($text, [
        'code' => true,
        'size' => 18,
        'font' => 'Consolas',
        'asciiFont' => 'Consolas',
        'color' => '1C2833',
        'bg' => 'F2F4F4',
        'before' => 120,
        'after' => 120
    ]);
}

function makeTable($headers, $rows, $widths = []) {
    $tbl = "<w:tbl>";
    $tbl .= "<w:tblPr>";
    $tbl .= "<w:tblW w:w=\"0\" w:type=\"auto\"/>";
    $tbl .= "<w:tblBorders>";
    $tbl .= "<w:top w:val=\"single\" w:sz=\"8\" w:space=\"0\" w:color=\"CCCCCC\"/>";
    $tbl .= "<w:bottom w:val=\"single\" w:sz=\"12\" w:space=\"0\" w:color=\"003366\"/>";
    $tbl .= "<w:left w:val=\"none\"/>";
    $tbl .= "<w:right w:val=\"none\"/>";
    $tbl .= "<w:insideH w:val=\"single\" w:sz=\"4\" w:space=\"0\" w:color=\"E5E7E9\"/>";
    $tbl .= "<w:insideV w:val=\"none\"/>";
    $tbl .= "</w:tblBorders>";
    $tbl .= "<w:tblCellMar><w:top w:w=\"100\" w:type=\"dxa\"/><w:bottom w:w=\"100\" w:type=\"dxa\"/><w:left w:w=\"140\" w:type=\"dxa\"/><w:right w:w=\"140\" w:type=\"dxa\"/></w:tblCellMar>";
    $tbl .= "</w:tblPr>";

    $tbl .= "<w:tr>";
    $tbl .= "<w:trPr><w:tblHeader/><w:cantSplit/></w:trPr>";
    foreach ($headers as $idx => $h) {
        $w = $widths[$idx] ?? 2000;
        $tbl .= "<w:tc>";
        $tbl .= "<w:tcPr>";
        $tbl .= "<w:tcW w:w=\"{$w}\" w:type=\"dxa\"/>";
        $tbl .= "<w:shd w:val=\"clear\" w:color=\"auto\" w:fill=\"003366\"/>";
        $tbl .= "</w:tcPr>";
        $tbl .= p($h, [
            'bold' => true,
            'color' => 'FFFFFF',
            'size' => 20,
            'font' => 'Khmer OS Muol Light',
            'asciiFont' => 'Calibri',
            'before' => 60,
            'after' => 60
        ]);
        $tbl .= "</w:tc>";
    }
    $tbl .= "</w:tr>";

    foreach ($rows as $rIndex => $row) {
        $rowBg = ($rIndex % 2 === 1) ? 'F8F9F9' : 'FFFFFF';
        $tbl .= "<w:tr>";
        $tbl .= "<w:trPr><w:cantSplit/></w:trPr>";
        foreach ($row as $cIndex => $val) {
            $w = $widths[$cIndex] ?? 2000;
            $tbl .= "<w:tc>";
            $tbl .= "<w:tcPr>";
            $tbl .= "<w:tcW w:w=\"{$w}\" w:type=\"dxa\"/>";
            $tbl .= "<w:shd w:val=\"clear\" w:color=\"auto\" w:fill=\"{$rowBg}\"/>";
            $tbl .= "</w:tcPr>";
            $tbl .= p($val, [
                'size' => 19,
                'color' => '2C3E50',
                'font' => 'Khmer OS Battambang',
                'asciiFont' => 'Calibri',
                'before' => 40,
                'after' => 40
            ]);
            $tbl .= "</w:tc>";
        }
        $tbl .= "</w:tr>";
    }

    $tbl .= "</w:tbl>";
    return $tbl;
}

// Function to generate image XML tag in document with valid numeric IDs
function makeImageXml($numericId, $rId, $name, $cx = 5400000, $cy = 3200000) {
    return "<w:p>
        <w:pPr><w:jc w:val=\"center\"/><w:spacing w:before=\"140\" w:after=\"140\"/></w:pPr>
        <w:r>
            <w:drawing>
                <wp:inline distT=\"0\" distB=\"0\" distL=\"0\" distR=\"0\">
                    <wp:extent cx=\"{$cx}\" cy=\"{$cy}\"/>
                    <wp:effectExtent l=\"0\" t=\"0\" r=\"0\" b=\"0\"/>
                    <wp:docPr id=\"{$numericId}\" name=\"{$name}\"/>
                    <wp:cNvGraphicFramePr>
                        <a:graphicFrameLocks xmlns:a=\"http://schemas.openxmlformats.org/drawingml/2006/main\" noChangeAspect=\"1\"/>
                    </wp:cNvGraphicFramePr>
                    <a:graphic xmlns:a=\"http://schemas.openxmlformats.org/drawingml/2006/main\">
                        <a:graphicData uri=\"http://schemas.openxmlformats.org/drawingml/2006/picture\">
                            <pic:pic xmlns:pic=\"http://schemas.openxmlformats.org/drawingml/2006/picture\">
                                <pic:nvPicPr>
                                    <pic:cNvPr id=\"{$numericId}\" name=\"{$name}\"/>
                                    <pic:cNvPicPr/>
                                </pic:nvPicPr>
                                <pic:blipFill>
                                    <a:blip xmlns:r=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships\" r:embed=\"{$rId}\"/>
                                    <a:stretch><a:fillRect/></a:stretch>
                                </pic:blipFill>
                                <pic:spPr>
                                    <a:xfrm><a:off x=\"0\" y=\"0\"/><a:ext cx=\"{$cx}\" cy=\"{$cy}\"/></a:xfrm>
                                    <a:prstGeom prst=\"rect\"><a:avLst/></a:prstGeom>
                                </pic:spPr>
                            </pic:pic>
                        </a:graphicData>
                    </a:graphic>
                </wp:inline>
            </w:drawing>
        </w:r>
    </w:p>";
}

// Build Document Body
$docXml = "";

$docXml .= p("សាកលវិទ្យាល័យ បៀលប្រាយ (BUILD BRIGHT UNIVERSITY)", [
    'size' => 30,
    'bold' => true,
    'color' => '003366',
    'align' => 'center',
    'font' => 'Khmer OS Muol Light',
    'asciiFont' => 'Arial',
    'before' => 200,
    'after' => 80
]);
$docXml .= p("មហាវិទ្យាល័យវិទ្យាសាស្ត្រ និងបច្ចេកវិទ្យា (FACULTY OF SCIENCE & TECHNOLOGY)", [
    'size' => 22,
    'bold' => true,
    'color' => '555555',
    'align' => 'center',
    'font' => 'Khmer OS Battambang',
    'asciiFont' => 'Arial',
    'before' => 0,
    'after' => 200
]);
$docXml .= p("ឯកសារលម្អិតស្តីពី គំនូសតាងលំហូរទិន្នន័យ", [
    'size' => 40,
    'bold' => true,
    'color' => '1B4F72',
    'align' => 'center',
    'font' => 'Khmer OS Muol Light',
    'asciiFont' => 'Arial',
    'before' => 150,
    'after' => 80
]);
$docXml .= p("DATA FLOW DIAGRAM (DFD) FULL SPECIFICATION", [
    'size' => 28,
    'bold' => true,
    'color' => '2874A6',
    'align' => 'center',
    'font' => 'Calibri',
    'asciiFont' => 'Calibri',
    'before' => 0,
    'after' => 150
]);
$docXml .= p("ប្រព័ន្ធគ្រប់គ្រងធនាគារ និងឥណទាន (Banking & Loan Management System)", [
    'size' => 26,
    'italic' => true,
    'color' => '333333',
    'align' => 'center',
    'font' => 'Khmer OS Battambang',
    'asciiFont' => 'Calibri',
    'before' => 0,
    'after' => 400
]);

// 1. NOTATIONS
$docXml .= heading("១. និយមន័យ និងនិមិត្តសញ្ញាគំនូសតាង (DFD Conventions)", 1);
$docXml .= p("គំនូសតាងលំហូរទិន្នន័យ (Data Flow Diagram - DFD) ត្រូវបានរៀបចំឡើងតាមស្តង់ដារ Yourdon & Coad / Gane & Sarson ដើម្បីបង្ហាញពីដំណើរការបំលែងទិន្នន័យ ចរន្តលំហូរព័ត៌មាន និងឃ្លាំងផ្ទុកទិន្នន័យនៃប្រព័ន្ធធនាគារ និងឥណទាន៖");

$notationTableHeaders = ["និមិត្តសញ្ញា", "ឈ្មោះបច្ចេកទេស", "ការបរិយាយមុខងារ"];
$notationTableRows = [
    ["[ ឈ្មោះ ]", "អង្គភាពខាងក្រៅ (External Entity)", "តំណាងឱ្យបុគ្គល ឬប្រព័ន្ធខាងក្រៅដែលមានអន្តរកម្មបញ្ជូន/ទទួលទិន្នន័យពីប្រព័ន្ធ (អតិថិជន, បុគ្គលិក, អ្នកគ្រប់គ្រង)"],
    ["( លេខ.ឈ្មោះ )", "ដំណើរការបំលែង (Process)", "តំណាងឱ្យសកម្មភាព ឬអនុគមន៍ដែលទទួលទិន្នន័យចូលមកកែច្នៃ គណនា និងបញ្ចេញផល (ឧទាហរណ៍៖ 1.0, 2.0...)"],
    ["| D# | ឈ្មោះ", "ឃ្លាំងផ្ទុកទិន្នន័យ (Data Store)", "តំណាងឱ្យតារាងក្នុងមូលដ្ឋានទិន្នន័យ (Database Tables) សម្រាប់រក្សាទុកព័ត៌មានជាអចិន្ត្រៃយ៍"],
    ["-------->", "លំហូរទិន្នន័យ (Data Flow)", "តំណាងឱ្យទិសដៅនៃទិន្នន័យ ឬឯកសារដែលធ្វើដំណើរឆ្លងកាត់ពីចំណុចមួយទៅចំណុចមួយទៀត"]
];
$docXml .= makeTable($notationTableHeaders, $notationTableRows, [1600, 3000, 4800]);

// 2. LEVEL 0 CONTEXT DIAGRAM
$docXml .= heading("២. DFD កម្រិត ០ ៖ គំនូសតាងបរិបទប្រព័ន្ធ (Context Diagram - Level 0)", 1);
$docXml .= p("គំនូសតាងបរិបទកម្រិត ០ បង្ហាញពីព្រំដែនប្រព័ន្ធទាំងមូល (System Boundary) ដោយចាត់ទុកប្រព័ន្ធទាំងមូលជាដំណើរការមេតែមួយ (0.0 Banking & Loan Management System) និងបង្ហាញពីការផ្លាស់ប្តូរទិន្នន័យជាមួយអង្គភាពខាងក្រៅសំខាន់ៗចំនួន ៣៖");

if ($hasImg1) {
    $docXml .= p("រូបភាពទី ១ ៖ គំនូសតាងបរិបទប្រព័ន្ធកម្រិត ០ (DFD Level 0 Context Diagram)", [
        'italic' => true,
        'bold' => true,
        'align' => 'center',
        'color' => '555555',
        'size' => 18,
        'before' => 100,
        'after' => 60
    ]);
    $docXml .= makeImageXml(1, "rIdImg1", "DFD Level 0 Context Diagram", 5400000, 3200000);
}

$contextDiagramAscii = "                 +---------------------------+
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
+---------------------------+             +---------------------------+";
$docXml .= codeBox($contextDiagramAscii);

$docXml .= heading("ការបរិយាយអំពីអង្គភាពខាងក្រៅ (External Entities):", 3);
$docXml .= p("អតិថិជន / អ្នកខ្ចីប្រាក់ (Customer / Borrower)៖ បញ្ចូលឯកសារផ្ទាល់ខ្លួន (KYC), ស្នើសុំកម្ចី, ដាក់ឯកសារទ្រព្យបញ្ចាំ, និងបង់ប្រាក់សងត្រឡប់ ឬផ្ញើប្រាក់បញ្ញើ។ ទទួលបានមកវិញនូវតារាងកាលវិភាគបង់ប្រាក់, វិក្កយបត្រទទួលប្រាក់ និងដំណឹងអនុម័តកម្ចី។", ['bullet' => true]);
$docXml .= p("មន្ត្រីឥណទាន / បុគ្គលិក (Loan Officer / Staff)៖ ផ្ទៀងផ្ទាត់អត្តសញ្ញាណអតិថិជន, បញ្ចូលទិន្នន័យទ្រព្យបញ្ចាំ, រៀបចំសំណើកម្ចី, និងកត់ត្រាការបង់ប្រាក់ប្រចាំខែ។", ['bullet' => true]);
$docXml .= p("ប្រធានសាខា / អ្នកគ្រប់គ្រងប្រព័ន្ធ (Branch Manager / Admin)៖ ពិនិត្យវាយតម្លៃ និងអនុម័តកម្ចី, កំណត់តួនាទី និងសិទ្ធិបុគ្គលិក (RBAC), ពិនិត្យរបាយការណ៍ចំណូល និងតាមដានកំណត់ត្រាសវនកម្មប្រព័ន្ធ (Audit Logs)។", ['bullet' => true]);

// 3. LEVEL 1 SYSTEM DIAGRAM
$docXml .= heading("៣. DFD កម្រិត ១ ៖ គំនូសតាងប្រព័ន្ធកម្រិតខ្ពស់ (System Level 1 Diagram)", 1);
$docXml .= p("DFD កម្រិត ១ បំបែកប្រព័ន្ធមេជា ៦ ដំណើរការស្នូល និង ៦ ឃ្លាំងផ្ទុកទិន្នន័យ (Data Stores) ស្របតាមរចនាសម្ព័ន្ធពិតប្រាកដនៃកម្មវិធី៖");

if ($hasImg2) {
    $docXml .= p("រូបភាពទី ២ ៖ គំនូសតាងលំហូរទិន្នន័យប្រព័ន្ធកម្រិត ១ (DFD Level 1 System Diagram)", [
        'italic' => true,
        'bold' => true,
        'align' => 'center',
        'color' => '555555',
        'size' => 18,
        'before' => 100,
        'after' => 60
    ]);
    $docXml .= makeImageXml(2, "rIdImg2", "DFD Level 1 System Diagram", 5600000, 3500000);
}

$level1ProcessesHeaders = ["លេខដំណើរការ", "ឈ្មោះដំណើរការ (Process Name)", "ភារកិច្ច និងប្រតិបត្តិការ"];
$level1ProcessesRows = [
    ["1.0", "ការផ្ទៀងផ្ទាត់ និងគ្រប់គ្រងសិទ្ធិ (Authentication & Access Control)", "ផ្ទៀងផ្ទាត់គណនីបុគ្គលិក និងអ្នកគ្រប់គ្រង ដោយផ្អែកលើតួនាទី និងសិទ្ធិ (Permissions: manage-loans, view-borrowers, view-reports)"],
    ["2.0", "ការគ្រប់គ្រងព័ត៌មានអតិថិជន (Customer Management)", "ចុះឈ្មោះ និងកែប្រែព័ត៌មានអតិថិជន (ឈ្មោះខ្មែរ/ឡាតាំង, អត្តសញ្ញាណប័ណ្ណ, ភេទ, ថ្ងៃខែឆ្នាំកំណើត, មុខរបរ, អាសយដ្ឋាន, លេខទូរស័ព្ទ)"],
    ["3.0", "ការគ្រប់គ្រងទ្រព្យបញ្ចាំ (Collateral Management)", "កត់ត្រាព័ត៌មានទ្រព្យធានាកម្ចី (ប្លង់ដី, កាតគ្រីយានយន្ត, អចលនទ្រព្យ), លេខប័ណ្ណកម្មសិទ្ធិ និងតម្លៃវាយតម្លៃទីផ្សារជាក់ស្តែង"],
    ["4.0", "ដំណើរការស្នើសុំ និងអនុម័តកម្ចី (Loan Processing & Approval)", "គណនាអត្រាការប្រាក់, រយៈពេល, រូបិយប័ណ្ណ (KHR/USD), បង្កើតកាលវិភាគបង់ប្រាក់ និងដំណើរការអនុម័តដោយប្រធានសាខា"],
    ["5.0", "ដំណើរការសងប្រាក់ និងប្រាក់បញ្ញើ (Repayment & Deposit Processing)", "ទទួលប្រាក់សងប្រចាំខែ, គណនាបំបែកប្រាក់ដើមនិងការប្រាក់, កាត់កងសមតុល្យបំណុលនៅសល់, និងគ្រប់គ្រងប្រាក់បញ្ញើសន្សំ"],
    ["6.0", "ការចេញរបាយការណ៍ និងសវនកម្ម (Reporting & Audit Logging)", "ទាញទិន្នន័យដើម្បីចេញជារបាយការណ៍ផលប័ត្រឥណទាន, បញ្ជីបំណុលយឺតយ៉ាវ, របាយការណ៍ចំណូល និងកត់ត្រារាល់សកម្មភាពរបស់អ្នកប្រើប្រាស់ក្នុងប្រព័ន្ធ"]
];
$docXml .= makeTable($level1ProcessesHeaders, $level1ProcessesRows, [1400, 3200, 4800]);

// 4. LEVEL 2 PROCESSES
$docXml .= heading("៤. DFD កម្រិត ២ ៖ ដំណើរការរងលម្អិត (Detailed Level 2 Processes)", 1);
$docXml .= heading("៤.១ ដំណើរការ ៤.០ ៖ ដំណើរការស្នើសុំ និងអនុម័តកម្ចី (Loan Management Sub-processes)", 2);
$docXml .= p("ដំណើរការ ៤.០ ត្រូវបានបំបែកជា ៤ ដំណើរការរង ដើម្បីគ្រប់គ្រងវដ្តជីវិតនៃកម្ចីទាំងមូល៖");

if ($hasImg3) {
    $docXml .= p("រូបភាពទី ៣ ៖ គំនូសតាងលំហូរទិន្នន័យកម្រិត ២ នៃដំណើរការកម្ចី (DFD Level 2 Loan Process)", [
        'italic' => true,
        'bold' => true,
        'align' => 'center',
        'color' => '555555',
        'size' => 18,
        'before' => 100,
        'after' => 60
    ]);
    $docXml .= makeImageXml(3, "rIdImg3", "DFD Level 2 Loan Process", 5400000, 3200000);
}

$loanSubprocessAscii = "[ អតិថិជន / មន្ត្រីឥណទាន ]
       |
       |--- (ព័ត៌មានស្នើសុំកម្ចី)
       v
( ៤.១ ទទួលពាក្យស្នើសុំកម្ចី )
       |
       |--- [ពិនិត្យលក្ខខណ្ឌបឋម]
       v
( ៤.២ ផ្ទៀងផ្ទាត់ទ្រព្យបញ្ចាំ និងប្រវត្តិឥណទាន ) <==== | D2: អតិថិជន |
       |                                         <==== | D3: ទ្រព្យបញ្ចាំ |
       |--- [លទ្ធផលវាយតម្លៃហានិភ័យ]
       v
( ៤.៣ វាយតម្លៃ និងសម្រេចអនុម័តកម្ចី ) <============== [ ប្រធានសាខា / Admin ]
       |                                                         |
       |--- [លទ្ធផល៖ យល់ព្រម ឬ បដិសេធ] <-----------------------+
       v
( ៤.៤ បើកផ្តល់ប្រាក់កម្ចី និងចេញកាលវិភាគ )
       |
       |---> [រក្សាទុកកិច្ចសន្យា & តារាងបង់ប្រាក់] ========> | D4: ឥណទាន/កម្ចី |
       |
       +---> [ប្រគល់សាច់ប្រាក់ និងតារាងកាលវិភាគ] ========> [ អតិថិជន / អ្នកខ្ចី ]";
$docXml .= codeBox($loanSubprocessAscii);

$docXml .= p("ដំណើរការ ៤.១ (ទទួលពាក្យស្នើសុំ)៖ បញ្ចូលទំហំទឹកប្រាក់ស្នើសុំ, រយៈពេល, រូបិយប័ណ្ណ (KHR/USD), និងគោលបំណងកម្ចី។", ['bullet' => true]);
$docXml .= p("ដំណើរការ ៤.២ (ផ្ទៀងផ្ទាត់ទ្រព្យបញ្ចាំ និងប្រវត្តិ)៖ ផ្ទៀងផ្ទាត់ប្រវត្តិអតិថិជនពី D2 និងពិនិត្យតម្លៃទីផ្សារនៃទ្រព្យបញ្ចាំពី D3 ដើម្បីធានាសមាមាត្រទំហំកម្ចីធៀបនឹងទ្រព្យ (LTV Ratio)។", ['bullet' => true]);
$docXml .= p("ដំណើរការ ៤.៣ (វាយតម្លៃ និងសម្រេចអនុម័តកម្ចី)៖ ប្រធានសាខាពិនិត្យ និងចុចអនុម័ត (Approve) ឬច្រានចោល (Reject)។", ['bullet' => true]);
$docXml .= p("ដំណើរការ ៤.៤ (បើកផ្តល់ប្រាក់កម្ចី និងចេញកាលវិភាគ)៖ ប្រព័ន្ធគណនាតារាងបង់ប្រាក់ប្រចាំខែ (Schedule), កត់ត្រាចូល D4, និងបោះពុម្ពតារាងជូនអតិថិជន។", ['bullet' => true]);

$docXml .= heading("៤.២ ដំណើរការ ៥.០ ៖ ដំណើរការសងប្រាក់ និងប្រាក់បញ្ញើ (Repayment Sub-processes)", 2);
$docXml .= p("ដំណើរការ ៥.០ ទទួលខុសត្រូវលើការកាត់កងបំណុល និងការចេញបង្កាន់ដៃទូទាត់ប្រាក់៖");

$repaymentSubprocessAscii = "[ អតិថិជន / អ្នកខ្ចី ]
       |
       |--- (សាច់ប្រាក់សងប្រចាំខែ)
       v
( ៥.១ ស្វែងរកកាលវិភាគបង់ប្រាក់ដែលដល់កំណត់ ) <==== | D4: ឥណទាន/កម្ចី |
       |
       |--- [ទិន្នន័យចំនួនទឹកប្រាក់ត្រូវបង់]
       v
( ៥.២ គណនាបំបែកប្រាក់ដើម និងការប្រាក់ )
       |
       |--- [ទិន្នន័យបំបែកការទូទាត់]
       v
( ៥.៣ កត់ត្រាការទូទាត់ និងកាត់កងសមតុល្យ )
       |
       |---> [កែប្រែសមតុល្យបំណុលនៅសល់] ==============> | D4: ឥណទាន/កម្ចី |
       |---> [រក្សាទុកកំណត់ត្រាប្រតិបត្តិការបង់ប្រាក់] ==> | D5: ការសងប្រាក់ |
       |
       +---> [ចេញបង្កាន់ដៃទទួលប្រាក់ជាផ្លូវការ] ========> [ អតិថិជន / អ្នកខ្ចី ]";
$docXml .= codeBox($repaymentSubprocessAscii);

// 5. DATA DICTIONARY
$docXml .= heading("៥. វចនានុក្រមទិន្នន័យ (Data Dictionary)", 1);
$docXml .= heading("៥.១ និយមន័យឃ្លាំងផ្ទុកទិន្នន័យ (Data Stores Definition)", 2);

$dataStoreHeaders = ["លេខកូដ", "ឈ្មោះឃ្លាំងទិន្នន័យ", "តារាង Database", "វាលទិន្នន័យសំខាន់ៗ (Attributes)"];
$dataStoreRows = [
    ["D1", "អ្នកប្រើប្រាស់ និងសិទ្ធិ", "users, roles, permissions", "UserID, Name, Email, PasswordHash, RoleID, PermissionsList, Status"],
    ["D2", "អតិថិជន", "customers", "CustomerID, FullNameKhmer, FullNameLatin, Gender, DOB, Phone, NationalID, Address, JobTitle"],
    ["D3", "ទ្រព្យបញ្ចាំ", "collaterals", "CollateralID, CustomerID, AssetType, Value, DocumentNumber, Status, Description"],
    ["D4", "ឥណទាន / កម្ចី", "loans", "LoanID, CustomerID, LoanAmount, Currency (USD/KHR), InterestRate, DurationMonths, Status, DisbursedDate"],
    ["D5", "ការសងប្រាក់ & បញ្ញើ", "repayments, deposits", "RepaymentID, LoanID, AmountPaid, PrincipalPortion, InterestPortion, PaymentDate, ReceiptNumber"],
    ["D6", "កំណត់ត្រាសវនកម្ម", "audit_logs", "LogID, UserID, Action, ModuleAffected, IPAddress, Timestamp, PreviousState, NewState"]
];
$docXml .= makeTable($dataStoreHeaders, $dataStoreRows, [1000, 2400, 2600, 3400]);

$docXml .= heading("៥.២ និយមន័យលំហូរទិន្នន័យចម្បង (Main Data Flows)", 2);
$docXml .= p("DF01 (ព័ត៌មានអតិថិជន KYC) = ឈ្មោះខ្មែរ + ឈ្មោះឡាតាំង + លេខអត្តសញ្ញាណប័ណ្ណ + ភេទ + ថ្ងៃខែឆ្នាំកំណើត + មុខរបរ + អាសយដ្ឋាន + លេខទូរស័ព្ទ", ['bullet' => true]);
$docXml .= p("DF02 (ព័ត៌មានទ្រព្យបញ្ចាំ) = លេខកូដអតិថិជន + ប្រភេទទ្រព្យ + លេខប័ណ្ណកម្មសិទ្ធិ/កាតគ្រី + តម្លៃប៉ាន់ស្មាន + ថ្ងៃវាយតម្លៃ", ['bullet' => true]);
$docXml .= p("DF03 (ព័ត៌មានស្នើសុំកម្ចី) = លេខកូដអតិថិជន + ចំនួនទឹកប្រាក់កម្ចី + រូបិយប័ណ្ណ (KHR/USD) + រយៈពេលខ្ចី + គោលបំណងកម្ចី", ['bullet' => true]);
$docXml .= p("DF04 (ការអនុម័តកម្ចី) = លេខកូដកម្ចី + អ្នកអនុម័ត (AdminID) + ស្ថានភាព (Approved/Rejected) + កាលបរិច្ឆេទអនុម័ត", ['bullet' => true]);
$docXml .= p("DF05 (ប្រតិបត្តិការសងប្រាក់) = លេខកូដកម្ចី + ចំនួនប្រាក់បានបង់ + ប្រាក់ដើម + ការប្រាក់ + ថ្ងៃបង់ប្រាក់", ['bullet' => true]);
$docXml .= p("DF06 (បង្កាន់ដៃទទួលប្រាក់) = លេខវិក្កយបត្រ + ឈ្មោះអតិថិជន + ចំនួនប្រាក់បានបង់ + សមតុល្យបំណុលនៅសល់ + ថ្ងៃត្រូវបង់លើកក្រោយ", ['bullet' => true]);
$docXml .= p("DF07 (របាយការណ៍សរុប) = ទំហំកម្ចីបើកផ្តល់សរុប + ប្រាក់ប្រមូលបានសរុប + សមតុល្យឥណទានសកម្ម + បញ្ជីកម្ចីយឺតយ៉ាវ (NPL)", ['bullet' => true]);

// 6. IPO TABLE
$docXml .= heading("៦. តារាងសង្ខេប IPO (ធាតុចូល - ដំណើរការ - ធាតុចេញ)", 1);

$ipoHeaders = ["លេខ & ដំណើរការ", "លំហូរធាតុចូល (Inputs)", "ប្រភព (Source)", "លំហូរធាតុចេញ (Outputs)", "គោលដៅ (Destination)"];
$ipoRows = [
    ["1.0 ការផ្ទៀងផ្ទាត់សិទ្ធិ", "អ៊ីមែល និងពាក្យសម្ងាត់", "បុគ្គលិក / Admin", "សិទ្ធិ និងវេន Session", "D1, ចំណុចប្រទាក់ Staff"],
    ["2.0 គ្រប់គ្រងអតិថិជន", "ព័ត៌មានអត្តសញ្ញាណប័ណ្ណ & KYC", "មន្ត្រីឥណទាន", "កំណត់ត្រាប្រវត្តិរូបអតិថិជន", "D2 (Customers)"],
    ["3.0 គ្រប់គ្រងទ្រព្យបញ្ចាំ", "ព័ត៌មានទ្រព្យ & តម្លៃវាយតម្លៃ", "បុគ្គលិក / អតិថិជន", "បញ្ជីចុះឈ្មោះទ្រព្យធានា", "D3 (Collaterals)"],
    ["4.0 គ្រប់គ្រងកម្ចី & អនុម័ត", "លក្ខខណ្ឌកម្ចី & ការសម្រេច", "Staff / Admin / D2, D3", "កិច្ចសន្យាកម្ចី & តារាងបង់ប្រាក់", "D4 (Loans), អតិថិជន"],
    ["5.0 សងប្រាក់ & បញ្ញើ", "សាច់ប្រាក់បង់សង ឬផ្ញើសន្សំ", "អតិថិជន / បេឡា / D4", "សមតុល្យថ្មី & វិក្កយបត្របង់ប្រាក់", "D4, D5, អតិថិជន"],
    ["6.0 របាយការណ៍ & សវនកម្ម", "កំណត់ត្រាប្រតិបត្តិការ & Logs", "D4, D5, ប្រព័ន្ធ", "របាយការណ៍ហិរញ្ញវត្ថុ & សវនកម្ម", "D6, ប្រធានសាខា"]
];
$docXml .= makeTable($ipoHeaders, $ipoRows, [1800, 2000, 1600, 2200, 1800]);

// 7. BUSINESS RULES
$docXml .= heading("៧. វិធានអាជីវកម្ម និងសុចរិតភាពប្រព័ន្ធ (Business Rules & Constraints)", 1);
$docXml .= p("១. គោលការណ៍រក្សាទិន្នន័យ (Data Conservation Rule)៖ គ្មានដំណើរការណាបង្កើតទិន្នន័យដោយគ្មានធាតុចូលនោះឡើយ (No Miracles) ហើយក៏គ្មានដំណើរការណាទទួលទិន្នន័យចូលដោយមិនបញ្ចេញផលនោះដែរ (No Black Holes)។ ឃ្លាំងទិន្នន័យ (Data Store) មិនអាចផ្ទេរទិន្នន័យទៅកាន់ឃ្លាំងទិន្នន័យមួយទៀតដោយផ្ទាល់បានទេ ពោលគឺត្រូវឆ្លងកាត់ដំណើរការ (Process) ជានិច្ច។", ['bullet' => true]);
$docXml .= p("២. ការគ្រប់គ្រងរូបិយប័ណ្ណពីរ (USD និង KHR)៖ រាល់ដំណើរការគណនាកម្ចី (ដំណើរការ ៤.០) និងការសងប្រាក់ (ដំណើរការ ៥.០) ត្រូវតែបែងចែកដាច់ដោយឡែករវាងប្រាក់ដុល្លារ ($) និងប្រាក់រៀល (៛) ដោយមិនច្របល់គណនីគ្នាឡើយ។", ['bullet' => true]);
$docXml .= p("៣. លក្ខខណ្ឌទ្រព្យបញ្ចាំធានាកម្ចី (Collateral Coverage Rule)៖ មុនពេលដំណើរការ ៤.៣ អនុម័តកម្ចី តម្លៃប៉ាន់ស្មាននៃទ្រព្យបញ្ចាំក្នុង D3: Collaterals ត្រូវតែធានាបាននូវអត្រាសុវត្ថិភាពខ្ពស់ជាង ឬស្មើនឹងទំហំទឹកប្រាក់កម្ចីដែលបានស្នើសុំស្របតាមគោលការណ៍ឥណទានធនាគារ។", ['bullet' => true]);
$docXml .= p("៤. កំណត់ត្រាសវនកម្មស្វ័យប្រវត្តិ (Automatic Audit Logging)៖ រាល់ការបង្កើត, កែប្រែ ឬលុបទិន្នន័យក្នុងដំណើរការ ២.០, ៤.០ និង ៥.០ នឹងបញ្ជូនលំហូរទិន្នន័យដោយស្វ័យប្រវត្តិទៅកាន់ D6: Audit Logs ដើម្បីកត់ត្រា អត្តសញ្ញាណអ្នកធ្វើ (User_ID), ប្រភេទសកម្មភាព (Action) និង ពេលវេលាជាក់ស្តែង (Timestamp)។", ['bullet' => true]);

// Wrap inside complete word document XML with standard namespaces
$documentXmlContent = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>
<w:document xmlns:w=\"http://schemas.openxmlformats.org/wordprocessingml/2006/main\"
            xmlns:r=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships\"
            xmlns:m=\"http://schemas.openxmlformats.org/officeDocument/2006/math\"
            xmlns:wp=\"http://schemas.openxmlformats.org/wordprocessingDrawing\"
            xmlns:a=\"http://schemas.openxmlformats.org/drawingml/2006/main\"
            xmlns:pic=\"http://schemas.openxmlformats.org/drawingml/2006/picture\">
    <w:body>
        {$docXml}
        <w:sectPr>
            <w:pgSz w:w=\"11906\" w:h=\"16838\"/>
            <w:pgMar w:top=\"1440\" w:right=\"1440\" w:bottom=\"1440\" w:left=\"1440\" w:header=\"720\" w:footer=\"720\" w:gutter=\"0\"/>
        </w:sectPr>
    </w:body>
</w:document>";

// [Content_Types].xml
$contentTypesXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
  <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>
  <Default Extension="xml" ContentType="application/xml"/>
  <Default Extension="png" ContentType="image/png"/>
  <Override PartName="/word/document.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.document.main+xml"/>
  <Override PartName="/word/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.styles+xml"/>
</Types>';

// _rels/.rels
$rootRelsXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="word/document.xml"/>
</Relationships>';

// word/_rels/document.xml.rels
$docRelsXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rIdStyles" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>';
if ($hasImg1) {
    $docRelsXml .= '<Relationship Id="rIdImg1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/image1.png"/>';
}
if ($hasImg2) {
    $docRelsXml .= '<Relationship Id="rIdImg2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/image2.png"/>';
}
if ($hasImg3) {
    $docRelsXml .= '<Relationship Id="rIdImg3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/image3.png"/>';
}
$docRelsXml .= '</Relationships>';

// word/styles.xml
$stylesXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<w:styles xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main">
  <w:docDefaults>
    <w:rPrDefault>
      <w:rPr>
        <w:rFonts w:ascii="Calibri" w:hAnsi="Calibri" w:cs="Khmer OS Battambang"/>
        <w:sz w:val="22"/>
        <w:szCs w:val="22"/>
      </w:rPr>
    </w:rPrDefault>
    <w:pPrDefault>
      <w:pPr>
        <w:spacing w:after="120" w:line="276" w:lineRule="auto"/>
      </w:pPr>
    </w:pPrDefault>
  </w:docDefaults>
</w:styles>';

// Generate DOCX files in both locations
$targets = [
    $docsDir . '/DFD_Full_Specification_BBU_Banking_System.docx',
    $baseDir . '/DFD_Full_Specification_BBU_Banking_System.docx'
];

foreach ($targets as $docxPath) {
    $zip = new ZipArchive();
    if ($zip->open($docxPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        die("Cannot create zip archive: {$docxPath}\n");
    }

    $zip->addFromString('[Content_Types].xml', $contentTypesXml);
    $zip->addFromString('_rels/.rels', $rootRelsXml);
    $zip->addFromString('word/document.xml', $documentXmlContent);
    $zip->addFromString('word/styles.xml', $stylesXml);
    $zip->addFromString('word/_rels/document.xml.rels', $docRelsXml);

    if ($hasImg1) {
        $zip->addFile($img1Path, 'word/media/image1.png');
    }
    if ($hasImg2) {
        $zip->addFile($img2Path, 'word/media/image2.png');
    }
    if ($hasImg3) {
        $zip->addFile($img3Path, 'word/media/image3.png');
    }

    $zip->close();
    echo "Saved DOCX: {$docxPath} (" . filesize($docxPath) . " bytes)\n";
}

// ALSO Generate Word-Compatible HTML (.doc) as 100% fail-safe backup
$img1Base64 = $hasImg1 ? base64_encode(file_get_contents($img1Path)) : '';
$img2Base64 = $hasImg2 ? base64_encode(file_get_contents($img2Path)) : '';
$img3Base64 = $hasImg3 ? base64_encode(file_get_contents($img3Path)) : '';

$htmlDoc = '<!DOCTYPE html>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:w="urn:schemas-microsoft-com:office:word"
      xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta charset="utf-8">
<title>DFD Full Specification - BBU Banking System</title>
<!--[if gte mso 9]>
<xml>
 <w:WordDocument>
  <w:View>Print</w:View>
  <w:Zoom>100</w:Zoom>
  <w:DoNotOptimizeForBrowser/>
 </w:WordDocument>
</xml>
<![endif]-->
<style>
body {
    font-family: "Khmer OS Battambang", "Calibri", Arial, sans-serif;
    font-size: 11pt;
    line-height: 1.5;
    color: #2b2b2b;
    margin: 40px;
}
h1 {
    font-family: "Khmer OS Muol Light", "Arial", sans-serif;
    color: #003366;
    font-size: 16pt;
    margin-top: 25px;
    margin-bottom: 10px;
    border-bottom: 2px solid #003366;
    padding-bottom: 4px;
}
h2 {
    font-family: "Khmer OS Muol Light", "Arial", sans-serif;
    color: #1a5276;
    font-size: 13pt;
    margin-top: 20px;
    margin-bottom: 8px;
}
h3 {
    font-family: "Khmer OS Battambang", "Calibri", sans-serif;
    color: #2874a6;
    font-weight: bold;
    font-size: 12pt;
    margin-top: 15px;
    margin-bottom: 6px;
}
.header-box {
    text-align: center;
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border: 1px solid #dcdcdc;
}
.header-box h2 {
    color: #003366;
    font-size: 15pt;
    margin: 0 0 5px 0;
}
.header-box h3 {
    color: #555555;
    font-size: 12pt;
    margin: 0 0 15px 0;
}
.header-box h1 {
    color: #1b4f72;
    font-size: 20pt;
    border: none;
    margin: 0 0 5px 0;
}
.header-box .subtitle {
    color: #2874a6;
    font-size: 14pt;
    font-weight: bold;
    margin: 0 0 10px 0;
}
.header-box .system-name {
    color: #333333;
    font-size: 13pt;
    font-style: italic;
    margin: 0;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin: 15px 0;
    font-size: 10pt;
}
th {
    background-color: #003366;
    color: #ffffff;
    font-family: "Khmer OS Muol Light", "Calibri", sans-serif;
    font-weight: normal;
    padding: 8px 10px;
    text-align: left;
    border: 1px solid #003366;
}
td {
    padding: 8px 10px;
    border: 1px solid #dddddd;
    vertical-align: top;
}
tr:nth-child(even) {
    background-color: #f8f9fa;
}
pre {
    background: #f2f4f4;
    border-left: 4px solid #003366;
    padding: 12px;
    font-family: Consolas, "Courier New", monospace;
    font-size: 9pt;
    line-height: 1.3;
    overflow-x: auto;
}
.img-container {
    text-align: center;
    margin: 20px 0;
}
.img-container img {
    max-width: 95%;
    height: auto;
    border: 1px solid #cccccc;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
}
.img-caption {
    font-size: 9.5pt;
    font-style: italic;
    color: #555555;
    margin-top: 6px;
    font-weight: bold;
}
ul {
    margin-top: 5px;
    margin-bottom: 10px;
    padding-left: 20px;
}
li {
    margin-bottom: 6px;
}
</style>
</head>
<body>

<div class="header-box">
    <h2>សាកលវិទ្យាល័យ បៀលប្រាយ (BUILD BRIGHT UNIVERSITY)</h2>
    <h3>មហាវិទ្យាល័យវិទ្យាសាស្ត្រ និងបច្ចេកវិទ្យា (FACULTY OF SCIENCE & TECHNOLOGY)</h3>
    <h1>ឯកសារលម្អិតស្តីពី គំនូសតាងលំហូរទិន្នន័យ</h1>
    <div class="subtitle">DATA FLOW DIAGRAM (DFD) FULL SPECIFICATION</div>
    <div class="system-name">ប្រព័ន្ធគ្រប់គ្រងធនាគារ និងឥណទាន (Banking & Loan Management System)</div>
</div>

<h1>១. និយមន័យ និងនិមិត្តសញ្ញាគំនូសតាង (DFD Conventions)</h1>
<p>គំនូសតាងលំហូរទិន្នន័យ (Data Flow Diagram - DFD) ត្រូវបានរៀបចំឡើងតាមស្តង់ដារ Yourdon & Coad / Gane & Sarson ដើម្បីបង្ហាញពីដំណើរការបំលែងទិន្នន័យ ចរន្តលំហូរព័ត៌មាន និងឃ្លាំងផ្ទុកទិន្នន័យនៃប្រព័ន្ធធនាគារ និងឥណទាន៖</p>
<table>
<tr>
    <th style="width:15%;">និមិត្តសញ្ញា</th>
    <th style="width:30%;">ឈ្មោះបច្ចេកទេស</th>
    <th style="width:55%;">ការបរិយាយមុខងារ</th>
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
<p>គំនូសតាងបរិបទកម្រិត ០ បង្ហាញពីព្រំដែនប្រព័ន្ធទាំងមូល (System Boundary) ដោយចាត់ទុកប្រព័ន្ធទាំងមូលជាដំណើរការមេតែមួយ (0.0 Banking & Loan Management System) និងបង្ហាញពីការផ្លាស់ប្តូរទិន្នន័យជាមួយអង្គភាពខាងក្រៅសំខាន់ៗចំនួន ៣៖</p>';

if ($img1Base64) {
    $htmlDoc .= '<div class="img-container">
        <img src="data:image/png;base64,' . $img1Base64 . '" alt="DFD Level 0 Context Diagram" />
        <div class="img-caption">រូបភាពទី ១ ៖ គំនូសតាងបរិបទប្រព័ន្ធកម្រិត ០ (DFD Level 0 Context Diagram)</div>
    </div>';
}

$htmlDoc .= '<pre>' . htmlspecialchars($contextDiagramAscii) . '</pre>

<h3>ការបរិយាយអំពីអង្គភាពខាងក្រៅ (External Entities):</h3>
<ul>
    <li><b>អតិថិជន / អ្នកខ្ចីប្រាក់ (Customer / Borrower)៖</b> បញ្ចូលឯកសារផ្ទាល់ខ្លួន (KYC), ស្នើសុំកម្ចី, ដាក់ឯកសារទ្រព្យបញ្ចាំ, និងបង់ប្រាក់សងត្រឡប់ ឬផ្ញើប្រាក់បញ្ញើ។ ទទួលបានមកវិញនូវតារាងកាលវិភាគបង់ប្រាក់, វិក្កយបត្រទទួលប្រាក់ និងដំណឹងអនុម័តកម្ចី។</li>
    <li><b>មន្ត្រីឥណទាន / បុគ្គលិក (Loan Officer / Staff)៖</b> ផ្ទៀងផ្ទាត់អត្តសញ្ញាណអតិថិជន, បញ្ចូលទិន្នន័យទ្រព្យបញ្ចាំ, រៀបចំសំណើកម្ចី, និងកត់ត្រាការបង់ប្រាក់ប្រចាំខែ។</li>
    <li><b>ប្រធានសាខា / អ្នកគ្រប់គ្រងប្រព័ន្ធ (Branch Manager / Admin)៖</b> ពិនិត្យវាយតម្លៃ និងអនុម័តកម្ចី, កំណត់តួនាទី និងសិទ្ធិបុគ្គលិក (RBAC), ពិនិត្យរបាយការណ៍ចំណូល និងតាមដានកំណត់ត្រាសវនកម្មប្រព័ន្ធ (Audit Logs)។</li>
</ul>

<h1>៣. DFD កម្រិត ១ ៖ គំនូសតាងប្រព័ន្ធកម្រិតខ្ពស់ (System Level 1 Diagram)</h1>
<p>DFD កម្រិត ១ បំបែកប្រព័ន្ធមេជា ៦ ដំណើរការស្នូល និង ៦ ឃ្លាំងផ្ទុកទិន្នន័យ (Data Stores) ស្របតាមរចនាសម្ព័ន្ធពិតប្រាកដនៃកម្មវិធី៖</p>';

if ($img2Base64) {
    $htmlDoc .= '<div class="img-container">
        <img src="data:image/png;base64,' . $img2Base64 . '" alt="DFD Level 1 System Diagram" />
        <div class="img-caption">រូបភាពទី ២ ៖ គំនូសតាងលំហូរទិន្នន័យប្រព័ន្ធកម្រិត ១ (DFD Level 1 System Diagram)</div>
    </div>';
}

$htmlDoc .= '<table>
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
<p>ដំណើរការ ៤.០ ត្រូវបានបំបែកជា ៤ ដំណើរការរង ដើម្បីគ្រប់គ្រងវដ្តជីវិតនៃកម្ចីទាំងមូល៖</p>';

if ($img3Base64) {
    $htmlDoc .= '<div class="img-container">
        <img src="data:image/png;base64,' . $img3Base64 . '" alt="DFD Level 2 Loan Process" />
        <div class="img-caption">រូបភាពទី ៣ ៖ គំនូសតាងលំហូរទិន្នន័យកម្រិត ២ នៃដំណើរការកម្ចី (DFD Level 2 Loan Process)</div>
    </div>';
}

$htmlDoc .= '<pre>' . htmlspecialchars($loanSubprocessAscii) . '</pre>
<ul>
    <li><b>ដំណើរការ ៤.១ (ទទួលពាក្យស្នើសុំ)៖</b> បញ្ចូលទំហំទឹកប្រាក់ស្នើសុំ, រយៈពេល, រូបិយប័ណ្ណ (KHR/USD), និងគោលបំណងកម្ចី។</li>
    <li><b>ដំណើរការ ៤.២ (ផ្ទៀងផ្ទាត់ទ្រព្យបញ្ចាំ និងប្រវត្តិ)៖</b> ផ្ទៀងផ្ទាត់ប្រវត្តិអតិថិជនពី D2 និងពិនិត្យតម្លៃទីផ្សារនៃទ្រព្យបញ្ចាំពី D3 ដើម្បីធានាសមាមាត្រទំហំកម្ចីធៀបនឹងទ្រព្យ (LTV Ratio)។</li>
    <li><b>ដំណើរការ ៤.៣ (វាយតម្លៃ និងសម្រេចអនុម័តកម្ចី)៖</b> ប្រធានសាខាពិនិត្យ និងចុចអនុម័ត (Approve) ឬច្រានចោល (Reject)។</li>
    <li><b>ដំណើរការ ៤.៤ (បើកផ្តល់ប្រាក់កម្ចី និងចេញកាលវិភាគ)៖</b> ប្រព័ន្ធគណនាតារាងបង់ប្រាក់ប្រចាំខែ (Schedule), កត់ត្រាចូល D4, និងបោះពុម្ពតារាងជូនអតិថិជន។</li>
</ul>

<h2>៤.២ ដំណើរការ ៥.០ ៖ ដំណើរការសងប្រាក់ និងប្រាក់បញ្ញើ (Repayment Sub-processes)</h2>
<p>ដំណើរការ ៥.០ ទទួលខុសត្រូវលើការកាត់កងបំណុល និងការចេញបង្កាន់ដៃទូទាត់ប្រាក់៖</p>
<pre>' . htmlspecialchars($repaymentSubprocessAscii) . '</pre>

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
<tr><td><b>D5</b></td><td>ការសងប្រាក់ & បញ្ញើ</td><td><code>repayments, deposits</code></td><td>RepaymentID, LoanID, AmountPaid, PrincipalPortion, InterestPortion, PaymentDate, ReceiptNumber</td></tr>
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
    <th style="width:20%;">លេខ & ដំណើរការ</th>
    <th style="width:20%;">លំហូរធាតុចូល (Inputs)</th>
    <th style="width:16%;">ប្រភព (Source)</th>
    <th style="width:24%;">លំហូរធាតុចេញ (Outputs)</th>
    <th style="width:20%;">គោលដៅ (Destination)</th>
</tr>
<tr><td><b>1.0 ការផ្ទៀងផ្ទាត់សិទ្ធិ</b></td><td>អ៊ីមែល និងពាក្យសម្ងាត់</td><td>បុគ្គលិក / Admin</td><td>សិទ្ធិ និងវេន Session</td><td>D1, ចំណុចប្រទាក់ Staff</td></tr>
<tr><td><b>2.0 គ្រប់គ្រងអតិថិជន</b></td><td>ព័ត៌មានអត្តសញ្ញាណប័ណ្ណ & KYC</td><td>មន្ត្រីឥណទាន</td><td>កំណត់ត្រាប្រវត្តិរូបអតិថិជន</td><td>D2 (Customers)</td></tr>
<tr><td><b>3.0 គ្រប់គ្រងទ្រព្យបញ្ចាំ</b></td><td>ព័ត៌មានទ្រព្យ & តម្លៃវាយតម្លៃ</td><td>បុគ្គលិក / អតិថិជន</td><td>បញ្ជីចុះឈ្មោះទ្រព្យធានា</td><td>D3 (Collaterals)</td></tr>
<tr><td><b>4.0 គ្រប់គ្រងកម្ចី & អនុម័ត</b></td><td>លក្ខខណ្ឌកម្ចី & ការសម្រេច</td><td>Staff / Admin / D2, D3</td><td>កិច្ចសន្យាកម្ចី & តារាងបង់ប្រាក់</td><td>D4 (Loans), អតិថិជន</td></tr>
<tr><td><b>5.0 សងប្រាក់ & បញ្ញើ</b></td><td>សាច់ប្រាក់បង់សង ឬផ្ញើសន្សំ</td><td>អតិថិជន / បេឡា / D4</td><td>សមតុល្យថ្មី & វិក្កយបត្របង់ប្រាក់</td><td>D4, D5, អតិថិជន</td></tr>
<tr><td><b>6.0 របាយការណ៍ & សវនកម្ម</b></td><td>កំណត់ត្រាប្រតិបត្តិការ & Logs</td><td>D4, D5, ប្រព័ន្ធ</td><td>របាយការណ៍ហិរញ្ញវត្ថុ & សវនកម្ម</td><td>D6, ប្រធានសាខា</td></tr>
</table>

<h1>៧. វិធានអាជីវកម្ម និងសុចរិតភាពប្រព័ន្ធ (Business Rules & Constraints)</h1>
<ul>
    <li><b>១. គោលការណ៍រក្សាទិន្នន័យ (Data Conservation Rule)៖</b> គ្មានដំណើរការណាបង្កើតទិន្នន័យដោយគ្មានធាតុចូលនោះឡើយ (No Miracles) ហើយក៏គ្មានដំណើរការណាទទួលទិន្នន័យចូលដោយមិនបញ្ចេញផលនោះដែរ (No Black Holes)។ ឃ្លាំងទិន្នន័យ (Data Store) មិនអាចផ្ទេរទិន្នន័យទៅកាន់ឃ្លាំងទិន្នន័យមួយទៀតដោយផ្ទាល់បានទេ ពោលគឺត្រូវឆ្លងកាត់ដំណើរការ (Process) ជានិច្ច។</li>
    <li><b>២. ការគ្រប់គ្រងរូបិយប័ណ្ណពីរ (USD និង KHR)៖</b> រាល់ដំណើរការគណនាកម្ចី (ដំណើរការ ៤.០) និងការសងប្រាក់ (ដំណើរការ ៥.០) ត្រូវតែបែងចែកដាច់ដោយឡែករវាងប្រាក់ដុល្លារ ($) និងប្រាក់រៀល (៛) ដោយមិនច្របល់គណនីគ្នាឡើយ។</li>
    <li><b>៣. លក្ខខណ្ឌទ្រព្យបញ្ចាំធានាកម្ចី (Collateral Coverage Rule)៖</b> មុនពេលដំណើរការ ៤.៣ អនុម័តកម្ចី តម្លៃប៉ាន់ស្មាននៃទ្រព្យបញ្ចាំក្នុង D3: Collaterals ត្រូវតែធានាបាននូវអត្រាសុវត្ថិភាពខ្ពស់ជាង ឬស្មើនឹងទំហំទឹកប្រាក់កម្ចីដែលបានស្នើសុំស្របតាមគោលការណ៍ឥណទានធនាគារ។</li>
    <li><b>៤. កំណត់ត្រាសវនកម្មស្វ័យប្រវត្តិ (Automatic Audit Logging)៖</b> រាល់ការបង្កើត, កែប្រែ ឬលុបទិន្នន័យក្នុងដំណើរការ ២.០, ៤.០ និង ៥.០ នឹងបញ្ជូនលំហូរទិន្នន័យដោយស្វ័យប្រវត្តិទៅកាន់ D6: Audit Logs ដើម្បីកត់ត្រា អត្តសញ្ញាណអ្នកធ្វើ (User_ID), ប្រភេទសកម្មភាព (Action) និង ពេលវេលាជាក់ស្តែង (Timestamp)។</li>
</ul>

</body>
</html>';

$htmlTargets = [
    $docsDir . '/DFD_Full_Specification_BBU_Banking_System.doc',
    $baseDir . '/DFD_Full_Specification_BBU_Banking_System.doc'
];

foreach ($htmlTargets as $htmlPath) {
    file_put_contents($htmlPath, $htmlDoc);
    echo "Saved Word DOC: {$htmlPath} (" . filesize($htmlPath) . " bytes)\n";
}

echo "All files generated successfully!\n";

