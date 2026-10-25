(function () {
  function buildColumnCards(table) {
    var headers = Array.from(table.querySelectorAll("thead th, thead td")).map(function (th) {
      return th.innerHTML.trim();
    });
    var rows = Array.from(table.querySelectorAll("tbody tr"));

    if (!headers.length || !rows.length) return null;

    var wrapper = document.createElement("div");
    wrapper.className = "wp-table-cards";

    headers.forEach(function (header, colIndex) {
      var column = document.createElement("div");
      column.className = "wp-table-cards__column";

      var headerEl = document.createElement("div");
      headerEl.className = "wp-table-cards__header";
      headerEl.innerHTML = header;
      column.appendChild(headerEl);

      rows.forEach(function (row) {
        var cells = row.querySelectorAll("td");
        var cell = cells[colIndex];
        if (!cell) return;

        var cellEl = document.createElement("div");
        cellEl.className = "wp-table-cards__cell";
        cellEl.innerHTML = cell.innerHTML;
        column.appendChild(cellEl);
      });

      wrapper.appendChild(column);
    });

    return wrapper;
  }

  function init() {
    document.querySelectorAll(".wp-block-table.is-style-cards table").forEach(function (table) {
      var cards = buildColumnCards(table);
      if (!cards) return;
      table.closest(".wp-block-table").appendChild(cards);
    });
  }

  if (document.readyState !== "loading") {
    init();
  } else {
    document.addEventListener("DOMContentLoaded", init);
  }
})();
