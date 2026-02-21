<?php
// เชื่อมต่อ MariaDB (ข้อมูลจากหน้าจอดำของคุณ)
$conn = new mysqli("localhost", "root", "รหัสผ่าน", "Adilah_database");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// เมื่อมีการส่งข้อมูลจากฟอร์มให้บันทึกลง Table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $node_val = $_POST['node_value']; 
    $conn->query("INSERT INTO tree_nodes (value) VALUES ('$node_val')");
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radial BST Galaxy</title>
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
            overflow: hidden; /* ซ่อน Scrollbar นอก */
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
            font-family: 'Rajdhani';
            font-size: 18px;
            text-align: center;
            outline: none;
        }
        input:focus { border-color: var(--primary); }

        button {
            padding: 8px 15px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-family: 'Rajdhani';
            text-transform: uppercase;
            transition: 0.3s;
        }
        
        .btn-action { background: var(--primary); color: #000; }
        .btn-action:hover { box-shadow: 0 0 15px var(--primary); }
        
        .btn-del { background: #ef4444; color: white; }
        .btn-del:hover { box-shadow: 0 0 15px #ef4444; }

        #message { margin-top: 10px; font-size: 14px; min-height: 20px; color: #94a3b8; }

        /* พื้นที่จักรวาล */
        #galaxy-container {
            position: relative;
            width: 100%;
            height: 75vh;
            margin-top: 20px;
            border-radius: 20px;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 70%);
            overflow: hidden;
            border: 1px solid #334155;
            box-shadow: inset 0 0 50px rgba(0,0,0,0.5);
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
            font-size: 18px;
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.3);
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 10;
        }

        /* Effect ตอนค้นหาเจอ */
        .node.active {
            background: var(--accent);
            color: white;
            border-color: white;
            box-shadow: 0 0 30px var(--accent);
            transform: scale(1.3);
            z-index: 20;
        }

        .line {
            position: absolute;
            background: var(--line-color);
            height: 2px;
            transform-origin: 0 0;
            z-index: 1;
            opacity: 0.6;
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
    
    <div class="controls">
        <input type="number" id="valInput" placeholder="Enter Number" onkeydown="if(event.key==='Enter') run('add')">
        <br><br>
        <button class="btn-action" onclick="run('add')">Add Node</button>
        <button class="btn-action" style="background:#a78bfa;" onclick="run('find')">Find</button>
        <button class="btn-del" onclick="run('del')">Delete</button>
        <div id="message">System Ready...</div>
    </div>

    <div id="galaxy-container">
        <div class="orbit-ring" style="width: 200px; height: 200px;"></div>
        <div class="orbit-ring" style="width: 400px; height: 400px;"></div>
        <div class="orbit-ring" style="width: 600px; height: 600px;"></div>
    </div>

    <script>
        // --- Logic BST เดิม (ถูกต้องตามหลักการ 100%) ---
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
            remove(data) { this.root = this._remove(this.root, data); }
            _remove(node, key) {
                if(!node) return null;
                if(key < node.data) { node.left = this._remove(node.left, key); return node; }
                else if(key > node.data) { node.right = this._remove(node.right, key); return node; }
                else {
                    if(!node.left && !node.right) return null;
                    if(!node.left) return node.right;
                    if(!node.right) return node.left;
                    let min = this._findMin(node.right);
                    node.data = min.data;
                    node.right = this._remove(node.right, min.data);
                    return node;
                }
            }
            _findMin(node) { while(node.left) node = node.left; return node; }
        }

        // --- ส่วนการวาดแบบ Radial (The Different Part) ---
        const bst = new BST();
        const container = document.getElementById('galaxy-container');
        const msg = document.getElementById('message');
        let nodeElements = {};

        function run(action) {
            const val = parseInt(document.getElementById('valInput').value);
            if(isNaN(val)) return;
            
            if(action === 'add') {
                if(bst.search(bst.root, val)) { msg.innerText = "Duplicate Data!"; return; }
                bst.insert(val);
                drawGalaxy();
                msg.innerText = `Node ${val} added to orbit.`;
            } else if(action === 'find') {
                const found = bst.search(bst.root, val);
                if(found) {
                    msg.innerText = `Target ${val} located!`;
                    highlight(val);
                } else msg.innerText = "Target not found in sector.";
            } else if(action === 'del') {
                if(!bst.search(bst.root, val)) { msg.innerText = "Target not found."; return; }
                bst.remove(val);
                drawGalaxy();
                msg.innerText = `Node ${val} destroyed.`;
            }
            document.getElementById('valInput').value = '';
            document.getElementById('valInput').focus();
        }

        function drawGalaxy() {
            container.innerHTML = `
                <div class="orbit-ring" style="width: 200px; height: 200px; opacity:0.3"></div>
                <div class="orbit-ring" style="width: 400px; height: 400px; opacity:0.2"></div>
                <div class="orbit-ring" style="width: 600px; height: 600px; opacity:0.1"></div>
            `;
            nodeElements = {};
            if(bst.root) {
                // Root อยู่ตรงกลาง (Center)
                const cx = container.offsetWidth / 2;
                const cy = container.offsetHeight / 2;
                
                // เริ่มคำนวณ: Node, CenterX, CenterY, AngleRange(มุมกว้าง), StartAngle(มุมเริ่ม), Level(รัศมี)
                placeNode(bst.root, cx, cy, 0, 180, 0); 
                
                drawLines(bst.root);
                drawNodes(bst.root);
            }
        }

        // สูตรลับ: เปลี่ยนจาก ซ้าย/ขวา เป็น องศา และ รัศมี
        function placeNode(node, cx, cy, angle, scope, level) {
            // Level 0 (Root) อยู่ตรงกลาง
            // Level อื่นๆ จะห่างออกไปเรื่อยๆ (radius)
            const radius = level * 70; // ระยะห่างแต่ละชั้น
            
            // แปลง Polar (มุม, รัศมี) เป็น Cartesian (x, y)
            // มุม -90 เพราะอยากให้ Root ชี้ขึ้นข้างบนเป็นหลัก (หรือเริ่มที่ 0 ก็ได้)
            const rad = (angle - 90) * (Math.PI / 180); 
            
            node.x = cx + (radius * Math.cos(rad));
            node.y = cy + (radius * Math.sin(rad));

            // คำนวณมุมของลูกหลาน
            // ลดขอบเขตมุมลงครึ่งหนึ่งในแต่ละชั้น (scope / 2)
            const nextScope = scope / 2;
            
            if(node.left) {
                // ลูกซ้าย: บิดไปทางลบ (ทวนเข็ม)
                placeNode(node.left, cx, cy, angle - nextScope, nextScope, level + 1);
            }
            if(node.right) {
                // ลูกขวา: บิดไปทางบวก (ตามเข็ม)
                placeNode(node.right, cx, cy, angle + nextScope, nextScope, level + 1);
            }
        }

        function drawNodes(node) {
            if(!node) return;
            const el = document.createElement('div');
            el.className = 'node';
            el.innerText = node.data;
            // ปรับตำแหน่งให้อยู่กึ่งกลางจุด
            el.style.left = (node.x - 25) + 'px';
            el.style.top = (node.y - 25) + 'px';
            container.appendChild(el);
            nodeElements[node.data] = el;
            
            drawNodes(node.left);
            drawNodes(node.right);
        }

        function drawLines(node) {
            if(!node) return;
            if(node.left) {
                createLine(node.x, node.y, node.left.x, node.left.y);
                drawLines(node.left);
            }
            if(node.right) {
                createLine(node.x, node.y, node.right.x, node.right.y);
                drawLines(node.right);
            }
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
                document.querySelectorAll('.node.active').forEach(e => e.classList.remove('active'));
                el.classList.add('active');
                setTimeout(() => el.classList.remove('active'), 2000);
            }
        }

        // Init Data
        [50, 30, 70, 20, 40, 60, 80].forEach(d => bst.insert(d));
        drawGalaxy();
    </script>
</body>
</html><!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radial BST Galaxy</title>
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
            overflow: hidden; /* ซ่อน Scrollbar นอก */
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
            font-family: 'Rajdhani';
            font-size: 18px;
            text-align: center;
            outline: none;
        }
        input:focus { border-color: var(--primary); }

        button {
            padding: 8px 15px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-family: 'Rajdhani';
            text-transform: uppercase;
            transition: 0.3s;
        }
        
        .btn-action { background: var(--primary); color: #000; }
        .btn-action:hover { box-shadow: 0 0 15px var(--primary); }
        
        .btn-del { background: #ef4444; color: white; }
        .btn-del:hover { box-shadow: 0 0 15px #ef4444; }

        #message { margin-top: 10px; font-size: 14px; min-height: 20px; color: #94a3b8; }

        /* พื้นที่จักรวาล */
        #galaxy-container {
            position: relative;
            width: 100%;
            height: 75vh;
            margin-top: 20px;
            border-radius: 20px;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 70%);
            overflow: hidden;
            border: 1px solid #334155;
            box-shadow: inset 0 0 50px rgba(0,0,0,0.5);
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
            font-size: 18px;
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.3);
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 10;
        }

        /* Effect ตอนค้นหาเจอ */
        .node.active {
            background: var(--accent);
            color: white;
            border-color: white;
            box-shadow: 0 0 30px var(--accent);
            transform: scale(1.3);
            z-index: 20;
        }

        .line {
            position: absolute;
            background: var(--line-color);
            height: 2px;
            transform-origin: 0 0;
            z-index: 1;
            opacity: 0.6;
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
    
    <div class="controls">
        <input type="number" id="valInput" placeholder="Enter Number" onkeydown="if(event.key==='Enter') run('add')">
        <br><br>
        <button class="btn-action" onclick="run('add')">Add Node</button>
        <button class="btn-action" style="background:#a78bfa;" onclick="run('find')">Find</button>
        <button class="btn-del" onclick="run('del')">Delete</button>
        <div id="message">System Ready...</div>
    </div>

    <div id="galaxy-container">
        <div class="orbit-ring" style="width: 200px; height: 200px;"></div>
        <div class="orbit-ring" style="width: 400px; height: 400px;"></div>
        <div class="orbit-ring" style="width: 600px; height: 600px;"></div>
    </div>

    <script>
        // --- Logic BST เดิม (ถูกต้องตามหลักการ 100%) ---
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
            remove(data) { this.root = this._remove(this.root, data); }
            _remove(node, key) {
                if(!node) return null;
                if(key < node.data) { node.left = this._remove(node.left, key); return node; }
                else if(key > node.data) { node.right = this._remove(node.right, key); return node; }
                else {
                    if(!node.left && !node.right) return null;
                    if(!node.left) return node.right;
                    if(!node.right) return node.left;
                    let min = this._findMin(node.right);
                    node.data = min.data;
                    node.right = this._remove(node.right, min.data);
                    return node;
                }
            }
            _findMin(node) { while(node.left) node = node.left; return node; }
        }

        // --- ส่วนการวาดแบบ Radial (The Different Part) ---
        const bst = new BST();
        const container = document.getElementById('galaxy-container');
        const msg = document.getElementById('message');
        let nodeElements = {};

        function run(action) {
            const val = parseInt(document.getElementById('valInput').value);
            if(isNaN(val)) return;
            
            if(action === 'add') {
                if(bst.search(bst.root, val)) { msg.innerText = "Duplicate Data!"; return; }
                bst.insert(val);
                drawGalaxy();
                msg.innerText = `Node ${val} added to orbit.`;
            } else if(action === 'find') {
                const found = bst.search(bst.root, val);
                if(found) {
                    msg.innerText = `Target ${val} located!`;
                    highlight(val);
                } else msg.innerText = "Target not found in sector.";
            } else if(action === 'del') {
                if(!bst.search(bst.root, val)) { msg.innerText = "Target not found."; return; }
                bst.remove(val);
                drawGalaxy();
                msg.innerText = `Node ${val} destroyed.`;
            }
            document.getElementById('valInput').value = '';
            document.getElementById('valInput').focus();
        }

        function drawGalaxy() {
            container.innerHTML = `
                <div class="orbit-ring" style="width: 200px; height: 200px; opacity:0.3"></div>
                <div class="orbit-ring" style="width: 400px; height: 400px; opacity:0.2"></div>
                <div class="orbit-ring" style="width: 600px; height: 600px; opacity:0.1"></div>
            `;
            nodeElements = {};
            if(bst.root) {
                // Root อยู่ตรงกลาง (Center)
                const cx = container.offsetWidth / 2;
                const cy = container.offsetHeight / 2;
                
                // เริ่มคำนวณ: Node, CenterX, CenterY, AngleRange(มุมกว้าง), StartAngle(มุมเริ่ม), Level(รัศมี)
                placeNode(bst.root, cx, cy, 0, 180, 0); 
                
                drawLines(bst.root);
                drawNodes(bst.root);
            }
        }

        // สูตรลับ: เปลี่ยนจาก ซ้าย/ขวา เป็น องศา และ รัศมี
        function placeNode(node, cx, cy, angle, scope, level) {
            // Level 0 (Root) อยู่ตรงกลาง
            // Level อื่นๆ จะห่างออกไปเรื่อยๆ (radius)
            const radius = level * 70; // ระยะห่างแต่ละชั้น
            
            // แปลง Polar (มุม, รัศมี) เป็น Cartesian (x, y)
            // มุม -90 เพราะอยากให้ Root ชี้ขึ้นข้างบนเป็นหลัก (หรือเริ่มที่ 0 ก็ได้)
            const rad = (angle - 90) * (Math.PI / 180); 
            
            node.x = cx + (radius * Math.cos(rad));
            node.y = cy + (radius * Math.sin(rad));

            // คำนวณมุมของลูกหลาน
            // ลดขอบเขตมุมลงครึ่งหนึ่งในแต่ละชั้น (scope / 2)
            const nextScope = scope / 2;
            
            if(node.left) {
                // ลูกซ้าย: บิดไปทางลบ (ทวนเข็ม)
                placeNode(node.left, cx, cy, angle - nextScope, nextScope, level + 1);
            }
            if(node.right) {
                // ลูกขวา: บิดไปทางบวก (ตามเข็ม)
                placeNode(node.right, cx, cy, angle + nextScope, nextScope, level + 1);
            }
        }

        function drawNodes(node) {
            if(!node) return;
            const el = document.createElement('div');
            el.className = 'node';
            el.innerText = node.data;
            // ปรับตำแหน่งให้อยู่กึ่งกลางจุด
            el.style.left = (node.x - 25) + 'px';
            el.style.top = (node.y - 25) + 'px';
            container.appendChild(el);
            nodeElements[node.data] = el;
            
            drawNodes(node.left);
            drawNodes(node.right);
        }

        function drawLines(node) {
            if(!node) return;
            if(node.left) {
                createLine(node.x, node.y, node.left.x, node.left.y);
                drawLines(node.left);
            }
            if(node.right) {
                createLine(node.x, node.y, node.right.x, node.right.y);
                drawLines(node.right);
            }
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
                document.querySelectorAll('.node.active').forEach(e => e.classList.remove('active'));
                el.classList.add('active');
                setTimeout(() => el.classList.remove('active'), 2000);
            }
        }

        // Init Data
        [50, 30, 70, 20, 40, 60, 80].forEach(d => bst.insert(d));
        drawGalaxy();
    </script>
</body>
</html>

