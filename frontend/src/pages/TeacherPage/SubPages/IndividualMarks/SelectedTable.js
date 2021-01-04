import React from 'react';
import data from "./data";


const SelectedTable = ({selected}) => {
        const dataFilter = [...data].filter((item, i) => item.id === Number(selected))


        const dataFilter2 = [...dataFilter].map((item, i) => {
            return (
                item.squad.map((element, i) => {
                        return (
                            <div key={element.lastName + i}>
                                <div>{element.name}</div>
                                <div>{element.lastName}</div>
                            </div>
                        )
                    }
                ))

        })

        return (
            <div>
                {dataFilter2}
            </div>
        );
    }
;

export default SelectedTable;
