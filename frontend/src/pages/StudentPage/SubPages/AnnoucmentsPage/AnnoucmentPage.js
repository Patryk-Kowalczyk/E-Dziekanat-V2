import React from "react";
import "./annoucmentspage.scss";
import Skeleton from "../../../../components/Skeleton";

const data = {
  id: 613,
  title: "Rozpoczęcie roku",
  date: "01-10-2020",
  text:
    'No hejka, co tam się z Tobą dzieje? Skąd to zwątpienie? Dlaczego chcesz teraz się poddać, tylko dlatego, że raz czy drugi Ci nie wyszło? To nie jest żaden powód. Musisz iść i walczyć. Osiągniesz cel. Prędzej czy później go osiągniesz, ale musisz iść do przodu, przeć, walczyć o swoje. Nie ważne, że wszystko dookoła jest przeciwko Tobie. Najważniejsze jest to, że masz tutaj wole zwycięstwa. To się liczy. Każdy może osiągnąć cel, nie ważne czy taki czy taki, ale trzeba iść i walczyć. To teraz masz trzy sekundy żeby się otrąsnąć, powiedzieć sobie "dobra basta", pięścią w stół, idę to przodu i osiągam swój cel. Pozdro.',
  added_by: "Jan Janowski",
};

export default function AnnoucmentPage() {
  return (
    <div className="annoucment-page">
      <h1>{data.title}</h1>
      <p className="date">
        Dodano: {data.date} przez {data.added_by}
      </p>
      <Skeleton count={3} />
      <p className="text">{data.text}</p>
    </div>
  );
}
