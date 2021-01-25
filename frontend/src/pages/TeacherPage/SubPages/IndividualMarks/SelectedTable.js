import React, {useState} from 'react';
import "./individualmarks.scss";
import Form from "./Form";
import {useSelector} from "react-redux";

const SelectedTable = ({selected}) => {
    const groupsData = useSelector((state) => state.classes.groups) || [];
    const dataFilter = groupsData.filter((item, i) => item.id_subject === Number(selected))
    const studentsGroup = [...dataFilter].map((item, i) => {
            return (
                item.squad.map((element, i) => {
                        return (
                            <Form key={Number(element.album)} selected={Number(selected)} element={element} infoGroup={element.group} infoForm={item.form} infoSubject={item.name}  s_id={item.id_subject} />
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
