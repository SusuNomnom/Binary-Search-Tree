<?php
// --- 1. ส่วนเชื่อมต่อฐานข้อมูล ---
$host     = getenv('DB_HOST') ?: "suha-mariadb-edo8du"; 
$username = getenv('DB_USER') ?: "suha";
$password = getenv('DB_PASS') ?: "Suha_2006";
$dbname   = getenv('DB_NAME') ?: "trees_db";

$conn = new mysqli($host, $username, $password);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    $db_status = "❌ Connection Failed: " . $conn->connect_error;
} else {
    // 2. สร้าง DB และ Table อัตโนมัติ (คะแนนข้อ 3)
    $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
    $conn->select_db($dbname);
    
    $sql_create_table = "CREATE TABLE IF NOT EXISTS bst_nodes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        node_value INT NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql_create_table);
    $db_status = "✅ Connected to MariaDB ($host)";
}

// 3. ส่วนของการจัดการข้อมูล (Add/Delete) - แก้ไขบั๊กเลข 0 โดยการเช็คค่าว่าง
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_val']) && $_POST['add_val'] !== "") {
        $val = (int)$_POST['add_val'];
        $conn->query("INSERT INTO bst_nodes (node_value) VALUES ($val)");
    } elseif (isset($_POST['del_val']) && $_POST['del_val'] !== "") {
        $val = (int)$_POST['del_val'];
        $conn->query("DELETE FROM bst_nodes WHERE node_value = $val");
    }
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
}

// 4. ดึงข้อมูลจากฐานข้อมูลมาวาดต้นไม้
$db_nodes = [];
$res = $conn->query("SELECT node_value FROM bst_nodes ORDER BY id ASC");
if ($res && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $db_nodes[] = (int)$row['node_value'];
    }
} else {
    // ถ้า DB ว่าง ให้แสดงตัวอย่างตั้งต้น
    $db_nodes = [50, 30, 70, 20, 40, 60, 80]; 
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radial BST Galaxy - MariaDB Edition</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --primary: #38bdf8;
            --accent: #f472b6;
            --text: #e2e8f0;
            --line-color: #475569;
        }
        body {
            font-family: 'Rajdhani', 'Sarabun', sans-serif;
            background-color: var(--bg-color);
            color: var(--text);
            text-align: center;
            margin: 0; padding: 20px;
            overflow: hidden;
        }
        h1 {
            text-transform: uppercase;
            letter-spacing: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }
        .controls {
            background: var(--card-bg);
            padding: 15px;
            border-radius: 12px;
            display: inline-block;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
            border: 1px solid #334155;
            z-index: 100;
            position: relative;
        }
        input {
            padding: 8px 15px;
            border-radius: 5px;
            border: 1px solid #475569;
            background: #0f172a;
            color: white;
            font-size: 18px;
            text-align: center;
            outline: none;
        }
        button {
            padding: 8px 15px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.3s;
        }
        .btn-action { background: var(--primary); color: #000; }
        .btn-del { background: #ef4444; color: white; }
        .db-badge { font-size: 12px; color: #10b981; margin-bottom: 10px; display: block; }
        
        #galaxy-container {
            position: relative;
            width: 100%;
            height: 70vh;
            margin-top: 20px;
            border-radius: 20px;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 70%);
            overflow: hidden;
            border: 1px solid #334155;
        }
        .node {
            width: 50px; height: 50px;
            background: rgba(15, 23, 42, 0.9);
            border: 2px solid var(--primary);
            border-radius: 50%;
            display: flex; justify-content: center; align-items: center;
            position: absolute;
            color: var(--primary);
            font-weight: bold;
            z-index: 10;
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .node.active { background: var(--accent); color: white; transform: scale(1.3); }
        .line {
            position: absolute;
            background: var(--line-color);
            height: 2px;
            transform-origin: 0 0;
            z-index: 1;
            opacity: 0.4;
        }
        .orbit-ring {
            position: absolute;
            border: 1px dashed #334155;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            top: 50%; left: 50%;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>
<body>

    <h1>Radial BST Galaxy</h1>
    <span class="db-badge">📡 Status: <?php echo $db_status; ?></span>
    
    <div class="controls">
        <form method="POST" id="dbForm" style="display:none;">
            <input type="hidden" name="add_val" id="add_val">
            <input type="hidden" name="del_val" id="del_val">
        </form>

        <input type="number" id="valInput" placeholder="Enter Number">
        <br><br>
        <button class="btn-action" onclick="dbAction('add')">Add Node</button>
        <button class="btn-action" style="background:#a78bfa;" onclick="runFind()">Find</button>
        <button class="btn-del" onclick="dbAction('del')">Delete</button>
        <div id="message" style="margin-top: 10px; font-size: 14px; min-height: 20px; color: #94a3b8;">System Ready...</div>
    </div>

    <div id="galaxy-container"></div>

    <script>
        // --- Logic BST ---
        class Node {
            constructor(data) {
                this.data = data;
                this.left = null; this.right = null;
                this.x = 0; this.y = 0;
            }
        }
        class BST {
            constructor() { this.root = null; }
            insert(data) {
                if(!this.root) this.root = new Node(data);
                else this._insert(this.root, new Node(data));
            }
            _insert(node, newNode) {
                if(newNode.data < node.data) {
                    if(!node.left) node.left = newNode; else this._insert(node.left, newNode);
                } else {
                    if(!node.right) node.right = newNode; else this._insert(node.right, newNode);
                }
            }
            search(node, data) {
                if(!node) return null;
                if(data < node.data) return this.search(node.left, data);
                else if(data > node.data) return this.search(node.right, data);
                else return node;
            }
        }

        const bst = new BST();
        const container = document.getElementById('galaxy-container');
        let nodeElements = {};

        // ฟังก์ชันส่งค่าไป PHP - แก้ไขบั๊กเพื่อป้องกันเลข 0
        function dbAction(type) {
            const input = document.getElementById('valInput');
            const val = input.value;

            // เช็คว่ากรอกตัวเลขหรือยัง
            if (val === "") {
                alert("กรุณากรอกตัวเลขก่อนครับ");
                return;
            }

            if(type === 'add') document.getElementById('add_val').value = val;
            if(type === 'del') document.getElementById('del_val').value = val;
            
            document.getElementById('dbForm').submit();
        }

        function runFind() {
            const val = parseInt(document.getElementById('valInput').value);
            if(isNaN(val)) return;
            const found = bst.search(bst.root, val);
            if(found) {
                highlight(val);
                document.getElementById('message').innerText = "Target Located!";
            } else {
                document.getElementById('message').innerText = "Not found.";
            }
        }

        function drawGalaxy() {
            container.innerHTML = `
                <div class="orbit-ring" style="width: 200px; height: 200px; opacity:0.3"></div>
                <div class="orbit-ring" style="width: 400px; height: 400px; opacity:0.2"></div>
                <div class="orbit-ring" style="width: 600px; height: 600px; opacity:0.1"></div>
            `;
            nodeElements = {};
            if(bst.root) {
                const cx = container.offsetWidth / 2;
                const cy = container.offsetHeight / 2;
                placeNode(bst.root, cx, cy, 0, 180, 0); 
                drawLines(bst.root);
                drawNodes(bst.root);
            }
        }

        function placeNode(node, cx, cy, angle, scope, level) {
            const radius = level * 80;
            const rad = (angle - 90) * (Math.PI / 180); 
            node.x = cx + (radius * Math.cos(rad));
            node.y = cy + (radius * Math.sin(rad));
            const nextScope = scope / 2;
            if(node.left) placeNode(node.left, cx, cy, angle - nextScope, nextScope, level + 1);
            if(node.right) placeNode(node.right, cx, cy, angle + nextScope, nextScope, level + 1);
        }

        function drawNodes(node) {
            if(!node) return;
            const el = document.createElement('div');
            el.className = 'node';
            el.innerText = node.data;
            el.style.left = (node.x - 25) + 'px';
            el.style.top = (node.y - 25) + 'px';
            container.appendChild(el);
            nodeElements[node.data] = el;
            drawNodes(node.left);
            drawNodes(node.right);
        }

        function drawLines(node) {
            if(!node) return;
            if(node.left) { createLine(node.x, node.y, node.left.x, node.left.y); drawLines(node.left); }
            if(node.right) { createLine(node.x, node.y, node.right.x, node.right.y); drawLines(node.right); }
        }

        function createLine(x1, y1, x2, y2) {
            const length = Math.sqrt((x2-x1)**2 + (y2-y1)**2);
            const angle = Math.atan2(y2-y1, x2-x1) * 180 / Math.PI;
            const line = document.createElement('div');
            line.className = 'line';
            line.style.width = length + 'px';
            line.style.left = x1 + 'px';
            line.style.top = y1 + 'px';
            line.style.transform = `rotate(${angle}deg)`;
            container.appendChild(line);
        }

        function highlight(val) {
            const el = nodeElements[val];
            if(el) {
                el.classList.add('active');
                setTimeout(() => el.classList.remove('active'), 2000);
            }
        }

        // โหลดข้อมูลจาก MariaDB
        const initialData = <?php echo json_encode($db_nodes); ?>;
        initialData.forEach(d => bst.insert(d));
        
        window.onload = drawGalaxy;
        window.onresize = drawGalaxy;
    </script>
</body>
</html>

