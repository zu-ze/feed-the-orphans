import React, { useState } from "react";
import { View } from "react-native";
import { Snackbar } from "react-native-paper";
// import Card from "../card";
import Ionicons from 'react-native-vector-icons/Ionicons';
import Map from "../components/Map";
import {styles} from '../core/Theme'

export const MyAreaScreen = ({navigation}) => {
    const [visible, setVisible] = React.useState(true);
    const onToggleSnackBar = () => setVisible(!visible);
    const onDismissSnackBar = () => setVisible(false);


    return (
        <View style={[styles.container, {flexDirection: "row"}]}>
            <View style={{ flex: 1 }}>
                {/* <Map /> */}
            </View>
            <Snackbar
                visible={visible}
                onDismiss={onDismissSnackBar}
                style={{
                    backgroundColor: "#4b88a2"
                }}
                action={{
                    label: "View",
                    onPress: () => {

                    }
                }}
            >
                Save the children is 100km from you.
            </Snackbar>
        </View>
    )
}
