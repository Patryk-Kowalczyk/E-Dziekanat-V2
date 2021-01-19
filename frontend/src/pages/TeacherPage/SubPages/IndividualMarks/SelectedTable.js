import React from 'react';
import data from "../../endpoints/marks.json";
import "./individualmarks.scss";


const SelectedTable = ({selected}) => {
        const dataFilter = [...data.groups].filter((item, i) => item.group_id === selected)


        const studentsGroup = [...dataFilter].map((item, i) => {
            return (
                item.squad.map((element, i) => {
                        return (
                            // <>
                            //     <div key={element.unique_number} className="nameLastName">
                            //         {element.first_name}
                            //         {" "}
                            //         {element.last_name}
                            //         <div style={{paddingLeft: "10px"}}>{"Oceny: "}</div>
                            //         {element.marks.map((e, i) => {
                            //             return (
                            //                 <div style={{paddingLeft: "10px"}} className="mark" key={e.id}>
                            //                     <div className="mark2">{e.mark}</div>
                            //                 </div>)
                            //         })}
                            //         <button>Edytuj</button>
                            //     </div>
                            // </>
                            //    ZROBIE TYLKO OSOBY
                            <div key={element.unique_number} className="nameLastName">
                                {element.first_name}
                                {" "}
                                {element.last_name}
                            </div>


                        )
                    }
                ))

        })

        return (
            <>
                {studentsGroup}
            </>
        );
    }
;

export default SelectedTable;
