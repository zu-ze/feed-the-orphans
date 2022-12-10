import React, { memo } from "react";
import {View, Text} from "react-native";
import Background from "./fto/components/Background";
import { styles } from "./fto/core/Theme";

export default function App() {

  return (
    <Background>
      
      <View style={[styles.container, { width: "100%"}]} >
          <View style={[styles.container, { backgroundColor: "#4b88a288", flexDirection: "column", justifyContent: "flex-end",paddingVertical: 2.5}]
          }>
            <View style={
              [
                styles.box, 
                {
                  backgroundColor: "#4b88a2", 
                  borderRadius: 100,
                  borderColor: "white",
                  borderWidth: 10, 
                  width: 200,
                  height: 200, 
                  position: "absolute", 
                  top: 2.5,
                  zIndex: 10
                }
              ]
              } >
            </View>
            <View style={
              [
                styles.box, 
                {
                  backgroundColor: "#efef2188",
                  width: "98%",
                  height: 200
                }
              ]
              } >
                <View>

                </View>
            </View>
          </View>
          <View style={[styles.container, { width: "98%" }]} >
              <View
                style={[styles.container, {flexDirection: "column", justifyContent: "flex-start", borderRadius: 5, backgroundColor: "#4b88a2", width: "100%" }]}
              >
                <View  style={{ backgroundColor: "white", padding: 10, width: '90%', borderRadius: 5 }}>
                  <Text style={{fontSize: 18}} >Contact</Text>
                </View>
                <View>

                </View>
              </View>
              <View
                style={[styles.container, {flexDirection: "column", justifyContent: "flex-start", borderRadius: 5, backgroundColor: "#4b88a2", width: "100%" }]}
              >
                <View  style={{ backgroundColor: "white", padding: 10, width: '90%', borderRadius: 5 }}>
                  <Text style={{fontSize: 18}} >Vision</Text>
                </View>
                <View>

                </View>
              </View>
              <View
                style={[styles.container, {flexDirection: "column", justifyContent: "flex-start", borderRadius: 5, backgroundColor: "#4b88a2", width: "100%" }]}
              >
                <View  style={{ backgroundColor: "white", padding: 10, width: '90%', borderRadius: 5 }}>
                  <Text style={{fontSize: 18}} >Mission</Text>
                </View>
                <View>

                </View>
              </View>
            </View>
      </View>
    </Background>
  )
}
