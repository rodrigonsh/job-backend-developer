@extends('layout')

@section('content')


<form method="POST" action="/buscaTermo">
    @csrf
    <details>

        <summary>Busca pelos campos name e category</summary>
        <small>(trazer resultados que batem com ambos os campos).</small>

        <div>
            <input required name="termo" />
            <button>Buscar</button>
        </div>
       

    </details>
</form>



<form method="POST" action="/categoria">
    @csrf
    <details>
        <summary>Busca por uma categoria específica.</summary>
        <select name="cat">
            @foreach($categorias as $cat)
            <option value="{{$cat->category}}">{{$cat->category}}</option>
            @endforeach
        </select>
        <button>Buscar</button>
    </details>
</form>



<form method="POST" action="/imagem">
    @csrf
    <details>
        <summary>Busca de produtos com e sem imagem.</summary>
        
        <label>
            <input type="radio" checked="checked" value="com" name="imagem" />
            Com imagens
        </label>

        <label>
            <input type="radio" value="sem" name="imagem" />
            Sem Imagens
        </label>

        <button>Buscar</button>

    </details>
</form>



<form method="POST" action="/id">
    @csrf
    <details>
        <summary>Buscar um produto pelo seu ID.</summary>
        <input required type="number" name="id" />
        <button>Buscar</button>
    </details>
</form>

<div id="results" style="display: none">

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Foto</th>
            </tr>
        </thead>

        <tbody></tbody>

    </table>

</div>

<script type="text/javascript">

    let forms = document.querySelectorAll("form")

    function buildAndShowList(data)
    {

        let results = document.querySelector("#results");
        results.style.display = "block";

        let tbody = document.querySelector("tbody");
        tbody.innerHTML = ""
        
        data.forEach(function(line)
        {
            let tr = document.createElement('tr')
            let id = document.createElement('td')
            let name = document.createElement('td')
            let cat = document.createElement('td')
            let foto = document.createElement('td')
            let a = document.createElement('a')

            id.textContent = line.id
            a.textContent = line.name
            cat.textContent = line.category
            foto.textContent = (line.image_url != "") ? "SIM" : "NÃO"

            a.href = "/produto/"+line.id

            name.appendChild(a)

            tr.appendChild(id)
            tr.appendChild(name)
            tr.appendChild(cat)
            tr.appendChild(foto)

            tbody.appendChild(tr)

        })
        
        setTimeout(function()
        {
            window.scrollTo({ top: 500, behavior: 'smooth' })
        }, 1000)
        


    }

    function submitForm(ev)
    {
        ev.preventDefault()
        ev.stopPropagation()

        let form = ev.target
        let fm = new FormData(form)

        let xhr = new XMLHttpRequest()
        xhr.onload = function()
        {
            
            let data = JSON.parse(this.responseText)
            
            if ( Array.isArray(data) )
            {
                buildAndShowList(data)
                return;
            }
            
            else
            {

                if ( 'exception' in data )
                {
                    alert(data.message)
                    return
                }

                window.location = "/produto/"+data.id
            }
            
        }
        xhr.onerror = function()
        {
            alert("Requisição Inválida")
        }
        xhr.open('POST', form.action)
        xhr.setRequestHeader('accept', 'application/json')
        xhr.send(fm)

    }

    forms.forEach(form => {
        form.addEventListener('submit', submitForm)
    })

</script>

<style>

    details
    {
        padding: 16px;
        border: 1px solid gray;
        border-radius: 5px;
        margin-bottom: 8px;
    }

    table
    {
        width: 100%;
        border-collapse: collapse;
    }

    tr td { padding: 8px; }
    tr:nth-child(odd) td { background: #eee; }

</style>

@endsection