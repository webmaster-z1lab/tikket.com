<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center border-bottom">Principais categorias</h3>

            <div class="card-sm-columns card-sm-2-count card-lg-3-count mt-4">
                <a href="{{ route('events', ['keyword' => 'party', 'period' => '']) }}" class="card bg-primary text-white text-center p-4 mb-4">
                    <h3>Festas</h3>
                </a>

                <a href="{{ route('events', ['keyword' => 'workshop', 'period' => '']) }}" class="card bg-primary text-white text-center p-4 mb-4">
                    <h3>Workshops</h3>
                </a>

                <a href="{{ route('events', ['keyword' => 'show', 'period' => '']) }}" class="card bg-primary text-white text-center p-4 mb-4">
                    <h3>Shows</h3>
                </a>

                <a href="{{ route('events', ['keyword' => 'class', 'period' => '']) }}" class="card bg-warning text-white text-center p-4 mb-4">
                    <h3>Cursos</h3>
                </a>

                <a href="{{ route('events', ['keyword' => 'congress', 'period' => '']) }}" class="card bg-warning text-white text-center p-4 mb-4">
                    <h3>Congressos</h3>
                </a>

                <a href="{{ route('events', ['keyword' => 'networking', 'period' => '']) }}" class="card bg-warning text-white text-center p-4 mb-4">
                    <h3>Networking</h3>
                </a>
            </div>
        </div>
    </div>
</div>
