import React from "react";
import {useSelector} from "react-redux";


export default function Meetings() {
    const info = useSelector((state) => state.info.meetings) || [];

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
                    {info.map((row, index) => {
                        return (
                            <tr key={index}>
                                <td>{row.name}</td>
                                <td>{row.who}</td>
                                <td>{row.time}</td>
                                <td>{row.date}</td>
                            </tr>
                        );
                    })}
                    </tbody>
                </table>
            </div>
        </div>
    );
}




