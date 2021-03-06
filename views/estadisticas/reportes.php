<div class="panel-admin">
  <?php include_once __DIR__ . "/../templates/header.php"; ?>

  <?php include_once __DIR__ . "/../templates/navegacion.php"; ?>

  <section class="section p-t-0">
    <div class="titulo-dashboard">
      <h3 class="text-left">Dashboard</h3>
      <p>Reportes Estadísticos</p>
    </div>

    <section class="estadisticas">
      <div class="grafico-ventas">
        <canvas id="graficoVentas" width="1000" height="300"></canvas>
      </div>

      <div class="graficos-torta-barra">
        <div class="grafico-usuarios">
          <canvas id="graficoUsuarios" width="400" height="400"></canvas>
        </div>

        <div class="grafico-estados">
          <canvas id="graficoEstados" width="400" height="400"></canvas>
        </div>
      </div>
    </section>

    <section class="reportes-estadisticas">
      <h3 class="nombre-pagina">Resúmenes Estadísticos</h3>

      <article class="reporte reporte-registrados">
        <div class="reporte-info">
          <p class="datos">
            <span><?php echo $registrados; ?></span>
            <span>Total Registrados</span>
          </p>

          <div class="reporte-icono">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 2.66666C8.64802 2.66666 2.66669 8.64799 2.66669 16C2.66669 23.352 8.64802 29.3333 16 29.3333C23.352 29.3333 29.3334 23.352 29.3334 16C29.3334 8.64799 23.352 2.66666 16 2.66666ZM16 26.6667C10.1187 26.6667 5.33335 21.8813 5.33335 16C5.33335 10.1187 10.1187 5.33332 16 5.33332C21.8814 5.33332 26.6667 10.1187 26.6667 16C26.6667 21.8813 21.8814 26.6667 16 26.6667Z" fill="white" />
              <path d="M13.332 18.116L10.2666 15.056L8.38397 16.944L13.3346 21.884L22.276 12.9427L20.3906 11.0573L13.332 18.116Z" fill="white" />
            </svg>
          </div>
        </div>

        <a class="btn-reporte text-center">
        </a>
      </article>

      <article class="reporte  reporte-ganancias">
        <div class="reporte-info">
          <p class="datos">
            <span>$<?php echo $ganancias; ?></span>
            <span>Ganancias Totales</span>
          </p>

          <div class="reporte-icono">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 20C13.5467 20 13.3333 18.8533 13.3333 18.6667H10.6667C10.6667 19.8933 11.5467 22.0667 14.6667 22.56V24H17.3333V22.56C20 22.1067 21.3333 20.3867 21.3333 18.6667C21.3333 17.1733 20.64 14.6667 16 14.6667C13.3333 14.6667 13.3333 13.8267 13.3333 13.3333C13.3333 12.84 14.2667 12 16 12C17.7333 12 17.8533 12.8533 17.8667 13.3333H20.5333C20.5153 12.425 20.1886 11.5499 19.607 10.8519C19.0254 10.154 18.2235 9.67486 17.3333 9.49333V8H14.6667V9.45333C12 9.89333 10.6667 11.6133 10.6667 13.3333C10.6667 14.8267 11.36 17.3333 16 17.3333C18.6667 17.3333 18.6667 18.24 18.6667 18.6667C18.6667 19.0933 17.84 20 16 20Z" fill="white" />
              <path d="M6.66667 2.66666H2.66667V5.33332H5.33334V28C5.33334 28.3536 5.47381 28.6927 5.72386 28.9428C5.97391 29.1928 6.31305 29.3333 6.66667 29.3333H25.3333C25.687 29.3333 26.0261 29.1928 26.2761 28.9428C26.5262 28.6927 26.6667 28.3536 26.6667 28V5.33332H29.3333V2.66666H6.66667ZM24 26.6667H8V5.33332H24V26.6667Z" fill="white" />
            </svg>
          </div>

        </div>

        <a class="btn-reporte text-center">
        </a>
      </article>

      <article class="reporte reporte-clientes">
        <div class="reporte-info">
          <p class="datos">
            <span><?php echo $clientes; ?></span>
            <span>Total Clientes</span>
          </p>

          <div class="reporte-icono">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M27.0534 11.0533L21.3334 16.7733L19.6 15.0533L17.72 16.9467L21.32 20.5467L28.9467 12.9467L27.0534 11.0533ZM5.33335 10.6667C5.31693 11.3715 5.44366 12.0724 5.70587 12.7269C5.96809 13.3814 6.36033 13.9759 6.85889 14.4745C7.35745 14.973 7.95195 15.3653 8.60644 15.6275C9.26093 15.8897 9.96181 16.0164 10.6667 16C11.3716 16.0164 12.0724 15.8897 12.7269 15.6275C13.3814 15.3653 13.9759 14.973 14.4745 14.4745C14.973 13.9759 15.3653 13.3814 15.6275 12.7269C15.8897 12.0724 16.0164 11.3715 16 10.6667C16.0164 9.96178 15.8897 9.2609 15.6275 8.60641C15.3653 7.95192 14.973 7.35742 14.4745 6.85886C13.9759 6.3603 13.3814 5.96806 12.7269 5.70584C12.0724 5.44363 11.3716 5.3169 10.6667 5.33332C9.96181 5.3169 9.26093 5.44363 8.60644 5.70584C7.95195 5.96806 7.35745 6.3603 6.85889 6.85886C6.36033 7.35742 5.96809 7.95192 5.70587 8.60641C5.44366 9.2609 5.31693 9.96178 5.33335 10.6667ZM13.3334 10.6667C13.3505 11.0214 13.2933 11.3758 13.1653 11.7071C13.0374 12.0384 12.8416 12.3393 12.5904 12.5904C12.3393 12.8415 12.0384 13.0373 11.7071 13.1653C11.3758 13.2932 11.0214 13.3505 10.6667 13.3333C10.312 13.3505 9.95756 13.2932 9.62626 13.1653C9.29496 13.0373 8.99408 12.8415 8.74295 12.5904C8.49182 12.3393 8.296 12.0384 8.16805 11.7071C8.04011 11.3758 7.98287 11.0214 8.00002 10.6667C7.98287 10.3119 8.04011 9.95752 8.16805 9.62622C8.296 9.29492 8.49182 8.99405 8.74295 8.74292C8.99408 8.49179 9.29496 8.29597 9.62626 8.16802C9.95756 8.04008 10.312 7.98284 10.6667 7.99999C11.0214 7.98284 11.3758 8.04008 11.7071 8.16802C12.0384 8.29597 12.3393 8.49179 12.5904 8.74292C12.8416 8.99405 13.0374 9.29492 13.1653 9.62622C13.2933 9.95752 13.3505 10.3119 13.3334 10.6667V10.6667ZM5.33335 24C5.33335 22.9391 5.75478 21.9217 6.50493 21.1716C7.25507 20.4214 8.27249 20 9.33335 20H12C13.0609 20 14.0783 20.4214 14.8284 21.1716C15.5786 21.9217 16 22.9391 16 24V25.3333H18.6667V24C18.6667 23.1245 18.4942 22.2576 18.1592 21.4488C17.8242 20.6399 17.3331 19.905 16.7141 19.2859C16.095 18.6669 15.3601 18.1758 14.5512 17.8408C13.7424 17.5058 12.8755 17.3333 12 17.3333H9.33335C7.56524 17.3333 5.86955 18.0357 4.61931 19.2859C3.36907 20.5362 2.66669 22.2319 2.66669 24V25.3333H5.33335V24Z" fill="white" />
            </svg>
          </div>
        </div>

        <a class="btn-reporte text-center">
        </a>
      </article>
    </section>
  </section>
</div>