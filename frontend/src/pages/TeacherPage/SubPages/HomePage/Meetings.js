import React from "react";

const data = [
    {
        sprawa: "Negocjacje podwyżki",
        kto: "Dziekan",
        godzina: '14:00',
        data: "2020-01-04",
    }, {
        sprawa: "Poprawa egzaminu",
        kto: "Michał Janek",
        godzina: '17.00',
        data: "2020-01-04",
    }, {
        sprawa: "Rozmowa o pracy magisterskiej",
        kto: "Jędrzej Burek",
        godzina: '11.00',
        data: "2020-01-05",
    },


];
export default function Meetings() {
    return (
        <div className="teacherhome__meetings">
            <h3>Najbliższe zaplanowane spotkania: </h3>
            <div className="teacherhome__meetings-meetings">
                <table className="black">
                    <thead>
                    <tr>
                        <th>W sprawie?</th>
                        <th>Z kim</th>
                        <th>Godzina</th>
                        <th>Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    {data.map((row, index) => {
                        return (
                            <tr key={index}>
                                <td>{row.sprawa}</td>
                                <td>{row.kto}</td>
                                <td>{row.godzina}</td>
                                <td>{row.data}</td>
                            </tr>
                        );
                    })}
                    </tbody>
                </table>
            </div>
        </div>
    );
}




